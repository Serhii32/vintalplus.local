@extends('shared.master')
@section('content')
<div class="container" style="min-height: 50vh">
	<div class="row">
		@include('shared.sidebar')
		<div class="col-12 col-md-8 col-lg-9">
			<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">{{ __('pages.articlesTitle') }}</h3>
			<div class="container">
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
		        <div class="custom-links py-4">{{$articles->links()}}</div>
			</div>
		</div>
	</div>
</div>
@endsection