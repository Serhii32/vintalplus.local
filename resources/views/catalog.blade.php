@extends('shared.master')
@section('content')
<div class="container" style="min-height: 50vh">
	<div class="row">
		@include('shared.sidebar')
		<div class="col-12 col-md-8 col-lg-9">
			<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">{{ __('pages.catalogTitle') }}</h3>
			<div class="my-3">
				<iframe style="width: 100%; height: 700px; border: none;" src="{{asset('pdf/catalog.pdf')}}"></iframe>
			</div>
			<div class="text-center my-3">
				<a class="btn btn-success text-center text-uppercase font-weight-bold" href="{{asset('pdf/catalog.pdf')}}" target="_blanc"><h2>{{ __('pages.downloadCatalog') }}</h2></a>
			</div>
		</div>
	</div>
</div>
@endsection