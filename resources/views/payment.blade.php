@extends('layouts.apps')

@section('content')

	<div class="banner banner-in">
			
	</div>

	<div class="container">
		<div class="check-out">
			@if(session('error_messages'))
			<div class="alert alert-danger" role="alert">
				<div class="panel-header text-danger">Error</div>
				<div class="panel-body">
				<ul style="list-style-type: none;">
				@foreach(session('error_messages') as $key => $value)
					<li>{{$value}}</li>
				@endforeach
				</ul>
				</div>
			</div>
			@endif
			<h2>Payment</h2>
			<div class="accordion" id="accordionExample">
  
				  @foreach(\App\PaymentMethodCategory::get() as $key)
				  <div class="card">
				    <div class="card-header" id="heading{{$key->id}}">
				      <h5 class="mb-0">
				        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$key->id}}" aria-expanded="true" aria-controls="collapse{{$key->id}}">
				          {{$key->name}}
				        </button>
				      </h5>
				    </div>

				    <div id="collapse{{$key->id}}" class="collapse" aria-labelledby="heading{{$key->id}}" data-parent="#accordionExample">
				      <div class="card-body">
				        @if(sizeof(\App\PaymentMethod::where('category_id',$key->id)->get())>1)
				        
				        @foreach(\App\PaymentMethod::where('category_id',$key->id)->get() as $kay)
				        <div class="card">
				          <div class="card-header" id="headingchild{{$kay->id}}">
				            <h5 class="mb-0">
				              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapsechild{{$kay->id}}" aria-expanded="true" aria-controls="collapsechild{{$kay->id}}">
				                {{$kay->name}}
				              </button>
				            </h5>
				          </div>
				          <div id="collapsechild{{$kay->id}}" class="collapse" aria-labelledby="headingchild{{$kay->id}}" data-parent="#collapse{{$key->id}}">
				            <div class="card-body">
				              Pembayaran melalui {{$kay->name}}
				              <hr>
				              <div class="text-right">
				                <a href="{{route('store_payment',[$kay->id])}}" class="btn btn-primary">Bayar</a>
				              </div>

				            </div>
				          </div>
				        </div>
				        @endforeach

				        @else

				          Pembayaran melalui {{\App\PaymentMethod::where('category_id',$key->id)->first()->name}}

				          <hr>
				          <div class="text-right">
				            <a href="{{route('store_payment',[\App\PaymentMethod::where('category_id',$key->id)->first()->id])}}" class="btn btn-primary">Bayar</a>
				          </div>

				        @endif

				      </div>
				    </div>
				  </div>
				  @endforeach
				</div>


			<div class="clearfix"> </div>
	    </div>
	</div>

@endsection