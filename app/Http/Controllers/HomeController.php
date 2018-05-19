<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Transaction;
use App\TransactionDetail;
use App\Product;
use App\PaymentMethod;
use App\PaymentMethodCategory;
use Auth;
use Illuminate\Support\Facades\Input;
use Ixudra\Curl\Facades\Curl;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addcart($id,Request $r)
    {
    	$product_id = $r->input('product_id');
    	$qty = $r->input('qty');
    	$order_id = Session::get('order_id');
    	$trx_id = Session::get('trx_id');
    	if($order_id==null){
    		$trx = new Transaction;
    		$trx->order_id = uniqid();
    		$trx->customer_id = Auth::user()->id;
    		$trx->status = "requested";
    		$trx->address = "";
            $trx->city = "";
            $trx->phone = "";
    		$trx->province = "";
    		$trx->postal_code = "";
    		$trx->country_code = "";
    		$trx->save();

    		$order_id = $trx->order_id;
    		Session::put('order_id',$order_id);
    		$trx_id = $trx->id;
    		Session::put('trx_id',$trx_id);
    	}

    	if($order_id!=null){
    		$detail = TransactionDetail::where('transaction_id',$trx_id)->where('product_id',$product_id)->first();

    		if(!isset($detail->id)){
	    		$detail = new TransactionDetail;
	    		$detail->transaction_id = $trx_id;
	    		$detail->product_id = $product_id;
	    		$detail->qty = $qty;
	    		$detail->amount = Product::find($product_id)->price*$qty;
	    		$detail->save();
    		}else{
    			$detail->qty = $detail->qty+$qty;
    			$detail->amount = Product::find($product_id)->price*$detail->qty;
    			$detail->save();
    		}

    		if($detail->id > 0){
    			$data['status'] = "success";
    			$data['message'] = "Item(s) added to cart";
    			return redirect()->route('product_detail',[$product_id])->with($data);
    		}else{
    			$data['status'] = "failed";
    			$data['message'] = "Item(s) not added to cart";
    			return redirect()->route('product_detail',[$product_id])->with($data);
    		}

    	}
    }
    public function cart()
    {
        $order_id = Session::get('order_id');
        $data = [];
        if($order_id!=null){
            $data['transaction'] = Transaction::where('order_id',$order_id)->first();
            $data['transaction_detail'] = TransactionDetail::where('transaction_id',$data['transaction']->id)->get();
        }else{
            $data['transaction'] = [];
            $data['transaction_detail'] = [];
        }
        return view('cart')->with($data);
    }
    public function changeqty($id, Request $r)
    {
        $order_id = Session::get('order_id');
        $trx_id = Session::get('trx_id');
        $data = [];
        if($order_id!=null){
            $data['transaction'] = Transaction::where('order_id',$order_id)->first();
            $data['transaction_detail'] = TransactionDetail::where('transaction_id',$data['transaction']->id)->get();
        }else{
            $data['transaction'] = [];
            $data['transaction_detail'] = [];
        }

        $trx_detail = TransactionDetail::where('id',$id)->where('transaction_id',$trx_id)->first();
        // dd($r->has('increase'));
        if($r->has('increase')){
        	$trx_detail->qty = $trx_detail->qty+1;
    	}else{
        	$trx_detail->qty = $trx_detail->qty-1;
    	}
    	$trx_detail->amount = Product::find($trx_detail->product_id)->price*$trx_detail->qty;
    	$trx_detail->save();
        

        return redirect()->route('cart');
    }
    public function checkout()
    {
        $order_id = Session::get('order_id');
        $data = [];
        if($order_id!=null){
            $data['transaction'] = Transaction::where('order_id',$order_id)->first();
            $data['transaction_detail'] = TransactionDetail::where('transaction_id',$data['transaction']->id)->get();
        }else{
            $data['transaction'] = [];
            $data['transaction_detail'] = [];
        }
        return view('checkout')->with($data);
    }
    public function reset()
    {
        Session::put('order_id',null);
        return redirect()->route('home');
    }

    public function store_checkout(Request $r)
    {
        $order_id = Session::get('order_id');

        $trx = Transaction::where('order_id',$order_id)->first();
        $trx->address = $r->input('address');
        $trx->city = $r->input('city');
        $trx->province = $r->input('province');
        $trx->postal_code = $r->input('postal_code');
        $trx->phone = $r->input('phone');
        $trx->country_code = "IDN";
        $trx->save();

        return redirect()->route('payment');
    }


    public function payment()
    {
        $order_id = Session::get('order_id');
        $data = [];
        if($order_id!=null){
            $data['transaction'] = Transaction::where('order_id',$order_id)->first();
            $data['transaction_detail'] = TransactionDetail::where('transaction_id',$data['transaction']->id)->get();
        }else{
            $data['transaction'] = [];
            $data['transaction_detail'] = [];
        }
        
        $data['payment_method_category'] = PaymentMethodCategory::get();

        return view('payment')->with($data);
    }

    public function store_payment($payment_method_id)
    {

        $payment_method = PaymentMethod::find($payment_method_id);
        $payment_method_category = PaymentMethodCategory::find($payment_method->category_id);


        $order_id = Session::get('order_id');
        $data = [];
        if($order_id!=null){
            $data['transaction'] = Transaction::where('order_id',$order_id)->first();
            $data['transaction_detail'] = TransactionDetail::where('transaction_id',$data['transaction']->id)->get();
        }else{
            $data['transaction'] = [];
            $data['transaction_detail'] = [];
        }

        $amount_total = 0;

        $build_json = [];
        $item_details = [];
        foreach ($data['transaction_detail'] as $key) {
            $amount_total += $key->amount;
            $item_details[] = [
                'id'=>$key->id,
                'price'=>$key->amount/$key->qty,
                'quantity'=>$key->qty,
                'name'=>\App\Product::find($key->product_id)->name,
                'brand'=>"ITX",
                'category'=>"Pakaian",
                'merchant_name'=>"ITX"
            ];
        }
        $item_details[] = [
            'id'=>$order_id,
            'price'=>$payment_method_category->service_fee,
            'quantity'=>1,
            'name'=>"Service Fee",
            'brand'=>"ITX",
            'category'=>"Pakaian",
            'merchant_name'=>"ITX"
        ];

        $transaction_details = [
            'order_id'=>$order_id,
            'gross_amount'=>$amount_total+$payment_method_category->service_fee,
            'external_id'=>$order_id."-".date("YmdHis")."-".uniqid()
        ];
        $enabled_payments = [
            $payment_method->key_name
        ];
        $custom_expiry = [
            'order_time'=>$data['transaction']->created_at,
            'expiry_duration'=>2,
            'unit'=>"hour"
        ];
        $customer_details = [
            'first_name'=>Auth::user()->name,
            'last_name'=>"",
            'email'=>Auth::user()->email,
            'phone'=>$data['transaction']->phone,
            'billing_address'=>[
                'first_name'=>Auth::user()->name,
                'last_name'=>"",
                'email'=>Auth::user()->email,
                'phone'=>$data['transaction']->phone,
                'address'=>$data['transaction']->address,
                'city'=>$data['transaction']->city,
                'province'=>$data['transaction']->province,
                'postal_code'=>$data['transaction']->postal_code,
                'country_code'=>$data['transaction']->country_code
            ],
            'shipping_address'=>[
                'first_name'=>Auth::user()->name,
                'last_name'=>"",
                'email'=>Auth::user()->email,
                'phone'=>$data['transaction']->phone,
                'address'=>$data['transaction']->address,
                'city'=>$data['transaction']->city,
                'province'=>$data['transaction']->province,
                'postal_code'=>$data['transaction']->postal_code,
                'country_code'=>$data['transaction']->country_code
            ],
        ];


        $build_json['transaction_details'] = $transaction_details;
        $build_json['customer_details'] = $customer_details;
        $build_json['custom_expiry'] = $custom_expiry;
        $build_json['item_details'] = $item_details;
        $build_json['enabled_payments'] = $enabled_payments;

        // dd($build_json);


        $response = Curl::to('https://app.sandbox.midtrans.com/snap/v1/transactions')
            ->withData( $build_json )
            ->withHeader( 'Authorization: Basic U0ItTWlkLXNlcnZlci1LTzZXYkdFZTRLU0FPU1RxQmhzdFlrY3o6' )
            ->withHeader( 'Content-Type: application/json' )
            ->asJson( true )
            ->post();

            // dd($response);/

        if(isset($response['redirect_url'])){
            Session::put('order_id',null);
            return redirect($response['redirect_url']);
        }else{
            return redirect()->route('payment')->with($response);
        }
    }
}
