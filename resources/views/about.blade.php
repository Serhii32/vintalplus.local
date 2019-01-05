@extends('shared.master')
@section('content')
<div class="container" style="min-height: 50vh">
	<div class="row">
		@include('shared.sidebar')
		<div class="col-12 col-md-8 col-lg-9">
			<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">{{ __('pages.aboutTitle') }}</h3>
			<h4 class="py-4 text-justify">
				{{ __('pages.aboutText') }}
			</h4>
		</div>
	</div>
</div>
@endsection