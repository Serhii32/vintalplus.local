@extends('shared.master')
@section('content')
<div class="container" style="min-height: 50vh">
    @foreach($categories as $category)
        <div class="my-3">
        	<h3 style="border-bottom: 5px #5cb85c solid; border-radius: 5px;" class="text-dark font-weight-bold text-uppercase text-center pt-4"><a class="card-link text-secondary p-1" href="{{route('page.category', $category->id)}}">{{$category->{'title' . strtoupper(App::getLocale())} }}</a></h3>
        	<div class="container">
        		<div class="row justify-content-between">
                    @foreach($category->products()->get()->take(5)->sortBy('priority') as $product)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3 px-1">
                            <div class="card h-100 shadow p-2">
                                <a class="card-link text-secondary p-1" href="{{route('page.product', $product->id)}}">
                                    <div class="text-center">
                                        <img class="img-fluid" src="{{$product->main_photo ? asset($product->main_photo) : asset('img/common/default.png')}}" alt="{{ $product->{'title' . strtoupper(App::getLocale())} }}">
                                    </div>
                                    <h5 class="text-center text-uppercase">{{$product->{'title' . strtoupper(App::getLocale())} }}</h5>
                                </a>
                                <h6 class="text-center text-uppercase">{{ number_format($product->price, 2, '.', ' ') }} {{ __('pages.uah') }}</h6>
                                <input id="order-button" style="min-width: 120px;" onclick="showModal({{$product->id}})" class="btn btn-success mb-0 w-50 mt-auto mx-auto text-uppercase font-weight-bold" type="submit" value="Заказать">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
    @include('shared.order-form')
    @if(count($services))
        <div class="my-3">
            <h3 style="border-bottom: 5px #5cb85c solid; border-radius: 5px;" class="text-dark font-weight-bold text-uppercase text-center pt-4"><a class="card-link text-secondary p-1" href="{{route('page.services')}}">{{ __('pages.servicesTitle') }}</a></h3>
            <div class="container">
                <div class="row justify-content-between">
                    @foreach($services as $service)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3 px-1">
                            <div class="card h-100 shadow p-2">
                                <a class="card-link text-secondary p-1" href="{{route('page.service', $service->id)}}">
                                    <div class="text-center">
                                        <img class="img-fluid" src="{{$service->main_photo ? asset($service->main_photo) : asset('img/common/default.png')}}" alt="{{ $service->{'title' . strtoupper(App::getLocale())} }}">
                                    </div>
                                    <h5 class="text-center text-uppercase">{{$service->{'title' . strtoupper(App::getLocale())} }}</h5>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if(count($partners))
        <div class="my-5">
            <link href="{{asset('/css/flickity.min.css')}}" rel="stylesheet">
            <script src="{{asset('/js/flickity.pkgd.min.js')}}"></script>
            <h3 style="border-bottom: 5px #5cb85c solid; border-radius: 5px;" class="text-dark font-weight-bold text-uppercase text-center pt-4"><a class="card-link text-secondary p-1" href="{{route('page.partners')}}">{{ __('pages.partnersTitle') }}</a></h3>
            <div class="main-carousel" data-flickity='{ "imagesLoaded": true, "percentPosition": false, "autoPlay": 2000, "wrapAround": true }'>
                @foreach($partners as $partner)
                    <div class="carousel-cell" style="background: transparent; width: 33%;">
                        <img style="display: block; margin: auto; height: 300px; object-fit: cover;" src="{{$partner->main_photo ? asset($partner->main_photo) : asset('img/common/default.png')}}" alt="{{ $partner->{'title' . strtoupper(App::getLocale())} }}" src="{{asset('img/common/default.png') }}">
                        <h3 class="text-center text-uppercase font-weight-bold">{{ $partner->{'title' . strtoupper(App::getLocale())} }}</h3>
                    </div>
                 @endforeach
            </div>
        </div>
    @endif
</div>
@endsection