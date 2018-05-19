@extends('layouts.apps')

@section('content')


<div class="banner">
    <div class="container"> 
        <h1>Our clothing , your comfort</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <a href="#content" class="scroll down"><img src="images/arr.png" alt=""></a>
    </div>
</div>
<div class="content" id="content">
    <div class="content-top">
        <div class="container">
            <div class="content-top-at">
            <a  href="{{route('product_home')}}" class="product-in hvr-shutter-in-horizontal">see all products</a>
            <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <div class="container">
    <div class="content-grid">
    <h3 class="future">OUR FEATURED PRODUCTS</h3>
    <p class="five">1/5</p>
    <div class="clearfix"> </div>
    <ul id="flexiselDemo1">   
        @foreach($data as $key)
        <li>
            <a href="{{route('product_detail',[$key->id])}}">
            <div class="men-grid">
                <img class="img-responsive" src="{{url('images/'.$key->image)}}" alt="">
                    <div class="value-in">
                        <p>{{$key->name}}</p>
                        <span>{{number_format($key->price,0,"",".")}} IDR</span>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </a>
        </li>
        @endforeach      

    </ul>
    <script type="text/javascript">
        $(window).load(function() {
            $("#flexiselDemo1").flexisel({
                visibleItems: 2,
                animationSpeed: 1000,
                autoPlay: true,
                autoPlaySpeed: 3000,            
                pauseOnHover: true,
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: { 
                    portrait: { 
                        changePoint:480,
                        visibleItems: 1
                    }, 
                    landscape: { 
                        changePoint:640,
                        visibleItems: 2
                    },
                    tablet: { 
                        changePoint:768,
                        visibleItems: 2
                    }
                }
            });
            
        });
    </script>
        </div>
    </div>
</div>

<div class="about-us">
    <div class="container">
    <h2>about us</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudexercitation</p>
    <i class="round"> </i>
    </div>
</div>

@endsection