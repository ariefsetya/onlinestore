@extends('layouts.apps')

@section('content')

	<div class="banner banner-in">
			
	</div>

	<div class="container">
		<div class="check-out">
			<h2>Cart</h2>
	    	    <table >
			  <tr>
				<th>ITEM</th>
				<th>QTY</th>		
				<th>PRICES</th>
				<th>DELIVERY DETAILS</th>
				<th>SUBTOTAL</th>
			  </tr>
			  @if(sizeof($transaction_detail)==0)
			  <tr>
			  	<td colspan="5"><h5 class="text-center">No Items</h5></td>
			  </tr>
			  @endif
			  @foreach($transaction_detail as $key)
			  <tr>
				<td class="ring-in"><a href="single.html" class="at-in"><img src="{{url('images/'.\App\Product::find($key->product_id)->image)}}" class="img-responsive" style="width: 120px;" alt=""></a>
				<div class="sed">
					<h5>{{\App\Product::find($key->product_id)->name}}</h5>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
				</div>
				<div class="clearfix"> </div></td>
				<td class="check">
					<form method="POST" action="{{route('changeqty',[$key->id])}}">
					{{csrf_field()}}
					<button class="hvr-shutter-in-horizontal" style="border: 0;width: 35px;height: 35px;line-height: 0px;padding: 0;margin: 0" name="decrease">-</button>
					<input type="text" value="{{$key->qty}}" readonly="true">
					<button class="hvr-shutter-in-horizontal" style="border: 0;width: 35px;height: 35px;line-height: 0px;padding: 0;margin: 0" name="increase">+</button>
					</form>
				</td>
				<td>{{number_format(\App\Product::find($key->product_id)->price,0,"",".")}} IDR</td>
				<td>FREE SHIPPING</td>
				<td>{{number_format($key->amount,0,"",".")}} IDR</td>
			  </tr>
			  @endforeach
		</table>
		@if(sizeof($transaction_detail)>0)
			<a href="{{route('checkout')}}" class=" hvr-shutter-in-horizontal">Checkout</a>
		@endif
		<div class="clearfix"> </div>
    </div>
</div>

@endsection