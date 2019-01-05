@extends('shared.master')
@section('content')
<div class="container" style="min-height: 50vh">
	<div class="row">
		@include('shared.sidebar')
		<div class="col-12 col-md-8 col-lg-9">
			<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">{{$service->{'title' . strtoupper(App::getLocale())} }}</h3>

			<div class="container">
				<div class="row justify-content-center px-4">
                    <div class="col-12 col-md-6 my-3 card h-100 shadow p-2">
                        <img class="img-fluid img-thumbnail" src="{{$service->main_photo ? asset($service->main_photo) : asset('img/common/default.png')}}" alt="{{ $service->{'title' . strtoupper(App::getLocale())} }}">
                    </div>
                    <div class="col-12 col-md-6 my-3">
                        <h4 class="text-center">{{$service->{'title' . strtoupper(App::getLocale())} }}</h4>
                        <p class="text-justify text-secondary" style="font-size: 20px;">{{$service->{'short_description' . strtoupper(App::getLocale())} }}</p>
                    </div>
                </div>
           
                <div class="text-secondary item-description m-2" style="font-size: 20px;">
                	{!! $service->{'description' . strtoupper(App::getLocale())} !!}
                </div>
			</div>

		</div>
	</div>
</div>
@endsection