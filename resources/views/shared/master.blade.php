<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>KEK</title>

    <meta name="author" content="serhii.bondarenko.ria@gmail.com">

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>
<body>
	<header style="background: #ccc;">
		<div class="container">

			<div class="row">
				<div class="col-12 col-md-4 m-auto text-center">
					<a href="{{route('page.index')}}"><img style="width: 90%; max-width: 220px;" src="{{ asset('img/Hypno_large.gif') }}"></a>
					<nav class="navbar navbar-expand navbar-light p-0">
						<ul class="navbar-nav m-auto">
							@foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
								<li class="nav-item main-menu-item py-2">
							        <a class="nav-link font-weight-bold text-uppercase" href="{{LaravelLocalization::getLocalizedURL($code)}}">{{$code}}</a>
							    </li>
			                @endforeach
		            	</ul>
		            </nav>
				</div>
				<div class="col-12 col-md-8 m-auto p-0">

					<div id="header-slider" class="carousel slide" data-ride="carousel" data-interval="3000">
					  	<ul class="carousel-indicators">
						    <li data-target="#header-slider" data-slide-to="0" class="active"></li>
						    <li data-target="#header-slider" data-slide-to="1"></li>
						    <li data-target="#header-slider" data-slide-to="2"></li>
					  	</ul>
					  	<div class="carousel-inner">
						    <div class="carousel-item active">
						      	<img style="width: 100%" src="https://www.w3schools.com/bootstrap4/la.jpg" alt="Los Angeles" height="250">
						      	<div class="carousel-caption">
						        	<h3>Los Angeles</h3>
						        	<p>We had such a great time in LA!</p>
						      	</div>   
						    </div>
						    <div class="carousel-item">
						      	<img style="width: 100%" src="https://www.w3schools.com/bootstrap4/chicago.jpg" alt="Chicago" height="250">
						      	<div class="carousel-caption">
						        	<h3>Chicago</h3>
						        	<p>Thank you, Chicago!</p>
						      	</div>   
						    </div>
						    <div class="carousel-item">
						      	<img style="width: 100%" src="https://www.w3schools.com/bootstrap4/ny.jpg" alt="New York" height="250">
						      	<div class="carousel-caption">
						        	<h3>New York</h3>
						        	<p>We love the Big Apple!</p>
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
				<button class="navbar-toggler m-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				</button>
			  	<div class="collapse navbar-collapse" id="navbarSupportedContent2">
				    <ul class="navbar-nav m-auto">
				      	<li class="nav-item main-menu-item py-2" @isset($aboutActive)style="background: #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.about')}}">{{ __('menu.about') }}</a>
				      	</li>
				      	<li class="nav-item main-menu-item py-2" @isset($productsActive)style="background: #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.products')}}">{{ __('menu.products') }}</a>
				      	</li>
				      	<li class="nav-item main-menu-item py-2" @isset($contactsActive)style="background: #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.contacts')}}">{{ __('menu.contacts') }}</a>
				      	</li>
				      	<li class="nav-item main-menu-item py-2" @isset($partnersActive)style="background: #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.partners')}}">{{ __('menu.partners') }}</a>
				      	</li>
				      	<li class="nav-item main-menu-item py-2" @isset($delivery_and_paymentActive)style="background:  #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.delivery-payment')}}">{{ __('menu.delivery_and_payment') }}</a>
				      	</li>
				      	<li class="nav-item main-menu-item py-2" @isset($articlesActive)style="background: #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.articles')}}">{{ __('menu.articles') }}</a>
				      	</li>
				      	<li class="nav-item main-menu-item py-2" @isset($projectsActive)style="background: #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.projects')}}">{{ __('menu.projects') }}</a>
				      	</li>
				      	<li class="nav-item main-menu-item py-2" @isset($jobsActive)style="background: #5cb85c;"@endisset>
				        	<a class="nav-link font-weight-bold text-uppercase text-white" href="{{route('page.jobs')}}">{{ __('menu.jobs') }}</a>
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
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2605.5072115215075!2d28.49863641568756!3d49.22887207932548!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x472d5b110e77db9b%3A0xdd996bb236af22aa!2z0LLRg9C70LjRhtGPINCf0YDQuNCy0L7QutC30LDQu9GM0L3QsCwgNDAsINCS0ZbQvdC90LjRhtGPLCDQktGW0L3QvdC40YbRjNC60LAg0L7QsdC70LDRgdGC0YwsIDIxMDAw!5e0!3m2!1suk!2sua!4v1542635381304" frameborder="0" style="border:0; width: 100%" allowfullscreen></iframe>
				</div>
				<div class="col-12 col-md-3 m-auto">
					<h5><span class="font-weight-bold text-uppercase">Адрес:</span><br>21001, г. Винница, ул. Привокзальная 40а<br><br><span class="font-weight-bold text-uppercase">Email:</span><br>vintalplus@gmail.com</h5>
				</div>
				<div class="col-12 col-md-3 m-auto">
					<h5><span class="font-weight-bold text-uppercase">Тел/факс:</span><br>(0432) 61-05-15<br>(050) 447-66-46<br>(067) 975-65-30<br>(067) 975-65-05</h5>
				</div>
				<div class="col-12 col-md-3 m-auto">
					<h5><span class="font-weight-bold text-uppercase">График:</span><br>Пн-Пт: 8.00-17.00<br>Сб-Вс: выходные</h5>
				</div>
			</div>
			<h5 class="font-weight-bold text-uppercase text-center">
				vintalplus © 2013-{{\Carbon\Carbon::now()->year}}  
			</h5>
		</div>
	</footer>
</body>
</html>