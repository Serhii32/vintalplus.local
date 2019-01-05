@extends('shared.master')
@section('content')
<div class="container" style="min-height: 50vh">
	<div class="row">
		@include('shared.sidebar')
		<div class="col-12 col-md-8 col-lg-9">
			<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">{{ __('pages.partnersTitle') }}</h3>
			<div class="container">
				<div class="row justify-content-center">
		            @foreach($partners as $partner)
		                <div class="col-12 col-sm-6 col-md-4 my-3">
		                    <div class="card h-100 shadow p-2">
	                            <div class="text-center">
	                                <img class="img-fluid item-photo" src="{{$partner->main_photo ? asset($partner->main_photo) : asset('img/common/default.png')}}" alt="{{ $partner->{'title' . strtoupper(App::getLocale())} }}">
	                            </div>
	                            <h5 class="text-center text-uppercase">{{$partner->{'title' . strtoupper(App::getLocale())} }}</h5>
		                    </div>
		                </div>
		            @endforeach
		        </div>
			</div>
		</div>
	</div>
</div>
@endsection