@extends('shared.master')
@section('content')
<div class="container" style="min-height: 50vh">
	<div class="row">
		@include('shared.sidebar')
		<div class="col-12 col-md-8 col-lg-9">
			<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">{{ __('pages.searchResult') }}</h3>
			@if(count($products))
				<div class="container">
					<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">{{ __('pages.productsTitle') }}</h3>
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
				</div>
			@endif
			@if(count($records))
				<div class="container">
					<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">{{ __('pages.recordsTitle') }}</h3>
					<div class="row justify-content-center">
			            @foreach($records as $record)
			                <div class="col-12 col-sm-6 my-3">
			                    <div class="card h-100 shadow p-2">
			                        <a class="card-link text-secondary p-1" href="{{route('page.record', $record->id)}}">
			                            <div class="text-center">
			                                <img class="img-fluid item-photo" src="{{$record->main_photo ? asset($record->main_photo) : asset('img/common/default.png')}}" alt="{{ $record->{'title' . strtoupper(App::getLocale())} }}">
			                            </div>
			                            <h5 class="text-center text-uppercase">{{$record->{'title' . strtoupper(App::getLocale())} }}</h5>
			                        </a>
			                    </div>
			                </div>
			            @endforeach
			        </div>
				</div>
			@endif
			@if(count($articles))
				<div class="container">
					<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">{{ __('pages.articlesTitle') }}</h3>
					<div class="row justify-content-center">
			            @foreach($articles as $article)
			                <div class="col-12 col-sm-6 my-3">
			                    <div class="card h-100 shadow p-2">
			                        <a class="card-link text-secondary p-1" href="{{route('page.article', $article->id)}}">
			                            <div class="text-center">
			                                <img class="img-fluid item-photo" src="{{$article->main_photo ? asset($article->main_photo) : asset('img/common/default.png')}}" alt="{{ $article->{'title' . strtoupper(App::getLocale())} }}">
			                            </div>
			                            <h5 class="text-center text-uppercase">{{$article->{'title' . strtoupper(App::getLocale())} }}</h5>
			                        </a>
			                    </div>
			                </div>
			            @endforeach
			        </div>
				</div>
			@endif
			@if(count($projects))
				<div class="container">
					<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">{{ __('pages.projectsTitle') }}</h3>
					<div class="row justify-content-center">
			            @foreach($projects as $project)
			                <div class="col-12 col-sm-6 my-3">
			                    <div class="card h-100 shadow p-2">
			                        <a class="card-link text-secondary p-1" href="{{route('page.project', $project->id)}}">
			                            <div class="text-center">
			                                <img class="img-fluid item-photo" src="{{$project->main_photo ? asset($project->main_photo) : asset('img/common/default.png')}}" alt="{{ $project->{'title' . strtoupper(App::getLocale())} }}">
			                            </div>
			                            <h5 class="text-center text-uppercase">{{$project->{'title' . strtoupper(App::getLocale())} }}</h5>
			                        </a>
			                    </div>
			                </div>
			            @endforeach
			        </div>
				</div>
			@endif
			@if(count($services))
				<div class="container">
					<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">{{ __('pages.servicesTitle') }}</h3>
					<div class="row justify-content-center">
			            @foreach($services as $service)
			                <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
			                    <div class="card h-100 shadow p-2">
			                        <a class="card-link text-secondary p-1" href="{{route('page.service', $service->id)}}">
			                            <div class="text-center">
			                                <img class="img-fluid item-photo" src="{{$service->main_photo ? asset($service->main_photo) : asset('img/common/default.png')}}" alt="{{ $service->{'title' . strtoupper(App::getLocale())} }}">
			                            </div>
			                            <h5 class="text-center text-uppercase">{{$service->{'title' . strtoupper(App::getLocale())} }}</h5>
			                        </a>
			                    </div>
			                </div>
			            @endforeach
			        </div>
				</div>
			@endif
		</div>
	</div>
</div>
@endsection