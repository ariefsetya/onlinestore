@extends('layouts.apps')

@section('content')

<div class="banner banner-in">
    
</div>
<div class="container">
			<div class="content-product">
				<h3 class="future-men">OUR PRODUCTS</h3>
				<?php $i = 0;?>
				@foreach($data as $key)
				<?php $i++;?>
				<a href="{{route('product_detail',[$key->id])}}"><div class="col-md-4 col-d">
				<div class=" men-grid in-men">
					<img class="img-responsive" src="{{url('images/'.$key->image)}}" alt="">
						<div class="value-in">
							<p>{{$key->name}}</p>
							<span>{{number_format($key->price,0,"",".")}} IDR</span>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
				</a>
				@if(sizeof($data)==$i or $i%3==0)
				<div class="clearfix"> </div>
				<hr>
				@endif
				@endforeach

			</div>
		</div>
@endsection