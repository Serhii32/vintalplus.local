@extends('shared.master')
@section('content')
<div class="container" style="min-height: 50vh">
	<div class="row">
		@include('shared.sidebar')
		<div class="col-12 col-md-8 col-lg-9">
			<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">{{ __('pages.productsTitle') }}</h3>
			<div class="container">
				<div class="row justify-content-center">
		            @foreach($products as $product)
		                <div class="col-12 col-sm-6 col-md-4 my-3">
		                    <div class="card h-100 shadow p-2">
		                        <a class="card-link text-secondary p-1" href="{{route('page.product', $product->id)}}">
		                            <div class="text-center">
		                                <img class="img-fluid item-photo" src="{{$product->main_photo ? asset($product->main_photo) : asset('img/common/default.png')}}" alt="{{ $product->{'title' . strtoupper(App::getLocale())} }}">
		                            </div>
		                            <h5 class="text-center text-uppercase">{{$product->{'title' . strtoupper(App::getLocale())} }}</h5>
		                        </a>
		                        <h6 class="text-center text-secondary">{{ __('pages.price') }}: {{ number_format($product->price, 2, '.', ' ') }} {{ __('pages.uah') }}</h6>
		                        <input id="order-button" style="min-width: 120px;" onclick="showModal({{$product->id}})" class="btn btn-success mb-0 w-50 mt-auto mx-auto text-uppercase font-weight-bold" type="submit" value="Заказать">
		                    </div>
		                </div>
		            @endforeach
		            @include('shared.order-form')
		        </div>
		        <div class="custom-links py-4">{{$products->links()}}</div>
			</div>
		</div>
	</div>
</div>
@endsection