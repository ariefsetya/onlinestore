@extends('layouts.apps')

@section('content')

	<div class="banner banner-in">
			
	</div>
		<!---->
	<div class="container">
		<div class="single">
		<div class="col-md-12">
			<div class="single_grid">
				<div class="grid">
				<ul id="etalage">
							<li>
								<a href="">
								<img class="etalage_thumb_image img-responsive" src="{{url('images/'.$data->image)}}" alt="" >
								<img class="etalage_source_image img-responsive" src="{{url('images/'.$data->image)}}" alt="" >
								</a>
							</li>
						    
						</ul>

						 <div class="clearfix"> </div>		
				  </div> 
				  <!---->
				  <div class="span1_of_1_des">
				  <div class="desc1">
					<h3>{{$data->name}}</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur est urna, eu lobortis tortor lacinia quis. Maecenas vulputate nisl nec nunc eleifend ullamcorper. Integer ut lectus semper, imperdiet massa eget, fringilla diam. Aenean elementum tincidunt dui nec pellentesque. Etiam dictum bibendum augue, eu vehicula risus fringilla ut. Phasellus non dui vitae nisi dapibus consequat. Aliquam porttitor sapien eu dui convallis, vitae porttitor ipsum iaculis. Sed ut lectus luctus, mollis magna non, dictum ex. Donec ornare facilisis placerat. Ut feugiat imperdiet interdum.</p>
					<h5>{{number_format($data->price,0,"",".")}} IDR</h5>
					<div class="available">
						<form method="POST" action="{{route('addcart',[$data->id])}}">
							<input type="hidden" name="product_id" value="{{$data->id}}">
							{{csrf_field()}}
							<h4>Available Options :</h4>
							<ul>
								<li>Quality:
									<select id="qty" name="qty">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</li>
							</ul>
							<div class="form-in">
								<button type="submit" style="border:0px;" class="hvr-shutter-in-horizontal">Add To Cart</button>
							</div>
						</form>
					</div>
					<div class="share-desc">
						<div class="share">
							<h4>Share Product :</h4>
							<ul class="share_nav">
								<li><a href="#"><img src="{{url('images/facebook.png')}}" title="facebook"></a></li>
								<li><a href="#"><img src="{{url('images/twitter.png')}}" title="Twiiter"></a></li>
								<li><a href="#"><img src="{{url('images/rss.png')}}" title="Rss"></a></li>
								<li><a href="#"><img src="{{url('images/gpluse.png')}}" title="Google+"></a></li>
				    		</ul>
						</div>
						<div class="clearfix"></div>
					</div>
			   	 </div>
			   	</div>
          	    <div class="clearfix"></div>
          	  </div>
			  <!---->
			</div>
	<!---->
   		<div class="clearfix"> </div>
	</div>
	</div>
@endsection