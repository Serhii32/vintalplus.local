@extends('shared.master')
@section('content')
<div class="container" style="min-height: 50vh">
	<div class="row">
		@include('shared.sidebar')
		<div class="col-12 col-md-8 col-lg-9">
			<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">{{ __('pages.contactsTitle') }}</h3>
			<div class="container">
				<div class="row my-5 border-bottom">
					<div class="col-md-6">
						<h4 class="font-weight-bold">{{ __('pages.contactsReception') }}</h4>
					</div>
					<div class="col-md-6">
						<h4><i class="fas fa-mobile-alt"></i> +38 0432 61 05 15</h4>
						<h4><i class="far fa-envelope"></i> nvp.modul@gmail.com</h4>
					</div>
				</div>
				<div class="row my-5 border-bottom">
					<div class="col-md-6">
						<h4 class="font-weight-bold">{{ __('pages.contactsSalesDepartment') }}</h4>
					</div>
					<div class="col-md-6">
						<h4><i class="fas fa-mobile-alt"></i> +38 050 447 66 46</h4>
						<h4><i class="far fa-envelope"></i> vintalplus@gmail.com</h4>
					</div>
				</div>
				<div class="row my-5 border-bottom">
					<div class="col-md-6">
						<h4 class="font-weight-bold">{{ __('pages.contactsTechnicalDepartment') }}</h4>
					</div>
					<div class="col-md-6">
						<h4><i class="fas fa-mobile-alt"></i> +38 067 975 65 30</h4>
						<h4><i class="far fa-envelope"></i> vintalplus@gmail.com</h4>
					</div>
				</div>
				<div class="row my-5 border-bottom">
					<div class="col-md-6">
						<h4 class="font-weight-bold">{{ __('pages.contactsCountingRoom') }}</h4>
					</div>
					<div class="col-md-6">
						<h4><i class="fas fa-mobile-alt"></i> +38 095 708 19 08</h4>
						<h4><i class="far fa-envelope"></i> nvp.modul@gmail.com</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection