<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($pageTitle) ? $pageTitle : 'NVPModul' }}</title>
    <meta name="description" content="{{ isset($pageDescription) ? $pageDescription : 'Продукция для перемещения грузов' }}"/>
    <meta name="author" content="serhii.bondarenko.ria@gmail.com">
    <meta name="keywords" content="{{ isset($pageKeywords) ? $pageKeywords : 'Продукция для перемещения грузов' }}">
    <link rel="canonical" href="{{ URL::current() }}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131420268-1"></script>
	<script>
	   window.dataLayer = window.dataLayer || [];
	   function gtag(){dataLayer.push(arguments);}
	   gtag('js', new Date());

	   gtag('config', 'UA-131420268-1');
	</script>

</head>
<body>
	<header style="background: #ccc;">
		@auth <a href="{{route('login')}}" class="btn btn-warning font-weight-bold text-uppercase position-fixed" style="z-index: 100; bottom: 0; right: 0;"><h3>Админка</h3></a> @endauth
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-4 m-auto text-center">
					<a href="{{route('page.index')}}"><img style="width: 90%; max-width: 220px;" src="{{ asset('img/common/logo.png') }}"></a>
					<nav class="navbar navbar-expand navbar-light p-0">
						<ul class="navbar-nav m-auto">
							@foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
								<li class="nav-item main-menu-item py-2">
							        <a class="nav-link font-weight-bold text-uppercase" href="{{LaravelLocalization::getLocalizedURL($code)}}">{{$code}}</a>
							    </li>
			                @endforeach
		            	</ul>
		            </nav>

		            <div id="myPopup" class="popuptext">
					    {!! Form::open(['route' => 'page.search', 'method'=>'get', 'class' => 'form-inline p-3 input-group-btn search-panel row']) !!}
							{!! Form::text('searchPhrase', old('searchPhrase'), ['placeholder' => __('pages.search')] + ($errors->has('searchPhrase') ? ['class'=>'form-control col-12 col-sm-11 col-md-10 rounded-0 is-invalid'] : ['class'=>'form-control col-12 col-sm-11 col-md-10 rounded-0'])) !!}
							{!! Form::button('<i class="fa fa-search"></i>', ['type' => 'submit', 'class' => 'btn col-12 col-sm-1 col-md-2 rounded-0', 'style' => 'background: #5cb85c']) !!}
							<span class="text-danger">{{ $errors->first('searchPhrase') }}</span>
						{!! Form::close() !!}
					</div>

				</div>
				<div class="col-12 col-md-8 m-auto p-0">

					<div id="header-slider" class="carousel slide" data-ride="carousel" data-interval="3000" style="max-width: 550px; margin: auto;">
					  	<ul class="carousel-indicators">
						    <li data-target="#header-slider" data-slide-to="0" class="active"></li>
						    <li data-target="#header-slider" data-slide-to="1"></li>
						    <li data-target="#header-slider" data-slide-to="2"></li>
						    <li data-target="#header-slider" data-slide-to="3"></li>
					  	</ul>
					  	<div class="carousel-inner">
						    <div class="carousel-item active">
						      	<img src="{{ asset('img/common/slider/slide1.jpg') }}" alt="NVPModul" height="250">
						      	<div class="carousel-caption">
						        	<h3></h3>
						        	<p></p>
						      	</div>   
						    </div>
						    <div class="carousel-item">
						      	<img src="{{ asset('img/common/slider/slide2.jpg') }}" alt="NVPModul" height="250">
						      	<div class="carousel-caption">
						        	<h3></h3>
						        	<p></p>
						      	</div>   
						    </div>
						    <div class="carousel-item">
						      	<img src="{{ asset('img/common/slider/slide3.jpg') }}" alt="NVPModul" height="250">
						      	<div class="carousel-caption">
						        	<h3></h3>
						        	<p></p>
						      	</div>   
						    </div>
						    <div class="carousel-item">
						      	<img src="{{ asset('img/common/slider/slide4.jpg') }}" alt="NVPModul" height="250">
						      	<div class="carousel-caption">
						        	<h3></h3>
						        	<p></p>
						      	</div>   
						    </div>
					  	</div>
					  	<a class="carousel-control-prev" href="#header-slider" data-slide="prev">
					    	<span class="carousel-control-prev-icon"></span>
					 	</a>
					  	<a class="carousel-control-next" href="#header-slider" data-slide="next">
					    	<span class="carousel-control-next-icon"></span>
					  	</a>
					</div>
				</div>
			</div>

		</div>
	</header>
	<nav style="background: #292929">
		<div class="container" style="color: #fff">
			<nav class="navbar navbar-expand-lg navbar-light p-0">
				<button style="background: white;" class="navbar-toggler mx-auto my-1" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				</button>
			  	<div class="collapse navbar-collapse" id="navbarSupportedContent2">
				    <ul class="navbar-nav m-auto">
				      	<li class="nav-item main-menu-item py-2 text-center" @isset($aboutActive)style="background: #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.about')}}">{{ __('menu.about') }}</a>
				      	</li>
				      	<li class="nav-item main-menu-item py-2 text-center" @isset($productsActive)style="background: #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.products')}}">{{ __('menu.products') }}</a>
				      	</li>
				      	<li class="nav-item main-menu-item py-2 text-center" @isset($contactsActive)style="background: #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.contacts')}}">{{ __('menu.contacts') }}</a>
				      	</li>
				      	<li class="nav-item main-menu-item py-2 text-center" @isset($partnersActive)style="background: #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.partners')}}">{{ __('menu.partners') }}</a>
				      	</li>
				      	<li class="nav-item main-menu-item py-2 text-center" @isset($delivery_and_paymentActive)style="background:  #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.delivery-payment')}}">{{ __('menu.delivery_and_payment') }}</a>
				      	</li>
				      	<li class="nav-item main-menu-item py-2 text-center" @isset($articlesActive)style="background: #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.articles')}}">{{ __('menu.articles') }}</a>
				      	</li>
				      	<li class="nav-item main-menu-item py-2 text-center" @isset($newsActive)style="background: #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.records')}}">{{ __('menu.news') }}</a>
				      	</li>
				      	<li class="nav-item main-menu-item py-2 text-center" @isset($projectsActive)style="background: #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.projects')}}">{{ __('menu.projects') }}</a>
				      	</li>
				      	<li class="nav-item main-menu-item py-2 text-center" @isset($jobsActive)style="background: #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.jobs')}}">{{ __('menu.jobs') }}</a>
				      	</li>
				      	<li class="nav-item main-menu-item py-2 text-center" @isset($catalogActive)style="background: #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.catalog')}}">{{ __('menu.catalog') }}</a>
				      	</li>
				    </ul>
			  	</div>
			</nav>
		</div>
	</nav>
	<main style="background: #fff">
		@yield('content')
	</main>
	<footer style="background: #ccc;">
		<div class="container">
			<div class="row py-4">
				<div class="col-12 col-md-3 m-auto text-center">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d921.1907667998453!2d28.5008404092301!3d49.22861153197919!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x472d5b11049c172d%3A0x5c92c6268739f3ea!2sPryvokzal&#39;na+St%2C+38%2C+Vinnytsia%2C+Vinnyts&#39;ka+oblast%2C+21000!5e0!3m2!1sen!2sua!4v1545484891820" frameborder="0" style="border:0; width: 100%" allowfullscreen></iframe>
				</div>
				<div class="col-12 col-md-3 m-auto">
					<h5><span class="font-weight-bold text-uppercase">{{ __('pages.address') }}:</span><br>21001, {{ __('pages.addressLine') }}<br><br><span class="font-weight-bold text-uppercase">Email:</span><br>nvp.modul@gmail.com</h5>
				</div>
				<div class="col-12 col-md-3 m-auto">
					<h5><span class="font-weight-bold text-uppercase">{{ __('pages.telFax') }}:</span><br>(0432) 61-05-15<br>(050) 447-66-46<br>(067) 975-65-30 <i class="fab fa-viber"></i><br>(067) 975-65-05</h5>
				</div>
				<div class="col-12 col-md-3 m-auto">
					<h5><span class="font-weight-bold text-uppercase">{{ __('pages.schedule') }}:</span><br>{{ __('pages.monFri') }}: 8.00-17.00<br>{{ __('pages.satSun') }}: {{ __('pages.dayOff') }}</h5>
					<h5><a style="color:#4267b2; font-size: 40px;" href="https://www.facebook.com/Modul-287408068641539" target="_blanc"><i class="fab fa-facebook"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a style="color:#7c529e; font-size: 40px;" href="viber://add?number=+380679756530"><i class="fab fa-viber"></i></a></h5>
				</div>
			</div>
			<h5 class="font-weight-bold text-uppercase text-center mb-0">
				nvpmodul © 2013-{{\Carbon\Carbon::now()->year}}  
			</h5>
		</div>
	</footer>
</body>
</html>