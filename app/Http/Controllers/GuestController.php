<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Session;
use App\Transaction;
use App\TransactionDetail;

class GuestController extends Controller
{
    public function products()
    {
        $order_id = Session::get('order_id');
    	$data['data'] = Product::paginate(10);
        if($order_id!=null){
            $data['transaction'] = Transaction::where('order_id',$order_id)->first();
            $data['transaction_detail'] = TransactionDetail::where('transaction_id',$data['transaction']->id)->get();
        }else{
            $data['transaction'] = [];
            $data['transaction_detail'] = [];
        }
    	return view('products')->with($data);
    }
    public function index()
    {
        $order_id = Session::get('order_id');
    	$data['data'] = Product::take(5)->get();
        if($order_id!=null){
            $data['transaction'] = Transaction::where('order_id',$order_id)->first();
            $data['transaction_detail'] = TransactionDetail::where('transaction_id',$data['transaction']->id)->get();
        }else{
            $data['transaction'] = [];
            $data['transaction_detail'] = [];
        }
        return view('welcome')->with($data);
    }
    public function products_detail($id)
    {
        $order_id = Session::get('order_id');
        $data['data'] = Product::find($id);
        if($order_id!=null){
            $data['transaction'] = Transaction::where('order_id',$order_id)->first();
            $data['transaction_detail'] = TransactionDetail::where('transaction_id',$data['transaction']->id)->get();
        }else{
            $data['transaction'] = [];
            $data['transaction_detail'] = [];
        }
        return view('product_detail')->with($data);
    }

    public function notification()
    {
        
        $response = json_decode(file_get_contents("php://input"));

        if($response->transaction_status=="capture"){
            if($response->payment_type=="credit_card"){
                if($response->fraud_status=="challenge"){

                    $trx = Transaction::where('order_id',$response->order_id)->first();
                    $trx->status = "challenge"; 
                    $trx->save();

                }else{

                    $trx = Transaction::where('order_id',$response->order_id)->first();
                    $trx->status = "paid"; 
                    $trx->save();

                }
            }
        }else if($response->transaction_status=="pending"){
            
            $trx = Transaction::where('order_id',$response->order_id)->first();
            $trx->status = "pending"; 
            $trx->save();

        }else if($response->transaction_status=="settlement"){

            $trx = Transaction::where('order_id',$response->order_id)->first();
            $trx->status = "paid"; 
            $trx->save();

        }else if($response->transaction_status=="deny"){

            $trx = Transaction::where('order_id',$response->order_id)->first();
            $trx->status = "denied"; 
            $trx->save();

        }else if($response->transaction_status=="cancel"){

            $trx = Transaction::where('order_id',$response->order_id)->first();
            $trx->status = "denied"; 
            $trx->save();

        }else if($response->transaction_status=="expire"){

            $trx = Transaction::where('order_id',$response->order_id)->first();
            $trx->status = "expire"; 
            $trx->save();

        }
    }
}
