@extends('layouts.apps')

@section('content')

	<div class="banner banner-in">
			
	</div>

	<div class="container">
		<div class="contact contact-form">
			<form method="POST" action="{{route('store_checkout')}}">
			<h2>Checkout</h2>
			<div class="contact-grids">
				<div class="contact-in">
					<div class="col-md-12 name-in">
						<span>Name</span>
						<input type="text" value="{{Auth::user()->name}}" name="name">
					</div>
					<div class="col-md-12 name-in">
						<span>Email</span>
						<input type="text" value="{{Auth::user()->email}}" name="email">
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="name-on">
					<div class="col-md-12">
						<span>Address</span>
						<textarea rows="1" name="address">{{$transaction->address OR ''}}</textarea>
					</div>
					<div class="clearfix"> </div>
				</div>

				<div class="contact-in">
					<div class="col-md-12 name-in">
						<span>City</span>
						<input type="text" value="{{$transaction->city OR ''}}" name="city">
					</div>
					<div class="col-md-12 name-in">
						<span>Province</span>
						<input type="text" value="{{$transaction->province OR ''}}" name="province">
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="contact-in">
					<div class="col-md-12 name-in">
						<span>Postal Code</span>
						<input type="text" value="{{$transaction->postal_code OR ''}}" name="postal_code">
					</div>
					<div class="col-md-12 name-in">
						<span>Phone Number</span>
						<input type="text" value="{{$transaction->phone OR '+62'}}" name="phone">
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="name-on">
					<div class="col-md-12">
						<span>Nationality</span>
						<textarea rows="1" readonly="true">[ID] Indonesia</textarea>
						<input type="submit" value="Payment" class="pull-right">
						{{csrf_field()}}
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
			</form>
		</div>

	</div>

@endsection