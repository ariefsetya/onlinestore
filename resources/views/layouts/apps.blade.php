<!DOCTYPE html>
<html>
<head>
<title>Trekking a Ecommerce Category Flat Bootstarp Responsive Website Template | Home :: w3layouts</title>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{url('js/jquery.min.js')}}"></script>
<script src="{{ url('bootstrap4/js/bootstrap.min.js') }}"></script>


      <!-- Bootstrap 4 -->
<link href="{{ url('bootstrap4/css/bootstrap.min.css') }}" rel="stylesheet">

<link href="{{url('css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<!--theme-style-->
<link href="{{url('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Trekking Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--fonts-->
<link href='http://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>
<!--//fonts-->
<script type="text/javascript" src="{{url('js/move-top.js')}}"></script>
<script type="text/javascript" src="{{url('js/easing.js')}}"></script>
<script type="text/javascript" src="{{url('js/jquery.flexisel.js')}}"></script>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						$(".scroll").click(function(event){		
							event.preventDefault();
							$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
						});
					});
				</script>
<!--//slider-script-->
<script>$(document).ready(function(c) {
	$('.alert-close').on('click', function(c){
		$('.message').fadeOut('slow', function(c){
	  		$('.message').remove();
		});
	});	  
});
</script>
<script>$(document).ready(function(c) {
	$('.alert-close1').on('click', function(c){
		$('.message1').fadeOut('slow', function(c){
	  		$('.message1').remove();
		});
	});	  
});
</script>

<link rel="stylesheet" href="{{url('css/etalage.css')}}">
<script src="{{url('js/jquery.etalage.min.js')}}"></script>
<script>
			jQuery(document).ready(function($){

				$('#etalage').etalage({
					thumb_image_width: 206,
					thumb_image_height: 239,
					source_image_width: 1000,
					source_image_height: 1200,
					show_hint: true,
					click_callback: function(image_anchor, instance_id){
						alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
					}
				});

			});
		</script>
</head>
<body>
<!--header-->
	<div class="header">
		<div class="container">
		<div class="header-top">		
			<div class="logo">
				<a href="index.html"><img src="{{url('images/logo.png')}}" alt=""></a>
			</div>
				<div class="top-nav">
					<span class="menu"><img src="{{url('images/menu.png')}}" alt=""> </span>
					<ul class="icon1 sub-icon1">
						<li  ><a href="{{url('')}}" >Home</a></li>
						<li><a href="{{route('product_home')}}" > Products</a></li>	
						<li><a href="#"><i></i></a>
						<ul class="sub-icon1 list">
						  <h3>Recently added items({{sizeof($transaction_detail)}})</h3>
						  <div class="shopping_cart">
						  	@if(sizeof($transaction_detail)==0)
							  <tr>
							  	<td colspan="5"><h5 class="text-center">No Items</h5></td>
							  </tr>
							  @endif
							  @foreach($transaction_detail as $key)
							  <div class="cart_box">
							   	 <div class="message">
							   	    	<div class="alert-close"></div> 
									
										<div class="list_img"><img src="{{url('images/'.\App\Product::find($key->product_id)->image)}}" class="img-responsive" alt=""></div>
										<div class="list_desc"><h4><a href="#">{{\App\Product::find($key->product_id)->name}}</a></h4><br>
										<span>Qty: {{$key->qty}}</span><br>
										<span>Amount: {{number_format($key->amount,0,"",".")}} IDR</span>
										</div>
		                              <div class="clearfix"></div>
	                              </div>
	                            </div>
	                            @endforeach
	                        </div>
							<div class="check_button"><a href="{{route('cart')}}">View Cart</a></div>
					      	<div class="clearfix"></div>
						</ul>
					</li>
					</ul>
					<!--script-->
				<script>
					$("span.menu").click(function(){
						$(".top-nav ul").slideToggle(500, function(){
						});
					});
				</script>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
		<!---->
		@yield('content')
		<!---->
		<div class="footer">
			<div class="footer-top">
				<div class="container">
				<a href="#" class="theme"><i> </i> “ E-commerce psd theme available ”</a>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="container">
				<div class="footer-bottom-at">
					<div class="col-md-6 footer-grid">
						<h3>Trekking</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					</div>
					<div class="col-md-6 footer-grid-in">
					<ul class="footer-nav">
						<li><a href="404.html" >credits </a>|</li>
						<li><a href="privacy.html" > Privacy</a>|</li>
						<li><a href="about.html" > about</a>|</li>
						<li><a href="contact.html" > contact</a></li>
					</ul>
					<p class="footer-class">Copyright © 2015 Trekking Template by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
					</div>
					<div class="clearfix"> </div>
				</div>
				</div>
			</div>
			<script type="text/javascript">
						$(document).ready(function() {
							/*
							var defaults = {
					  			containerID: 'toTop', // fading element id
								containerHoverID: 'toTopHover', // fading element hover id
								scrollSpeed: 1200,
								easingType: 'linear' 
					 		};
							*/
							
							$().UItoTop({ easingType: 'easeOutQuart' });
							
						});
					</script>
				<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>


		</div>
</body>
</html>
