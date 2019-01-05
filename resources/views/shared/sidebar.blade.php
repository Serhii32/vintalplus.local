<div class="col-12 col-md-4 col-lg-3">
    <div class="m-2 mb-4 bg-white border border-light shadow rounded">
    	<h5 style="background: #5cb85c;" class="text-light font-weight-bold text-uppercase text-center p-4 mb-0 styled-background"><a class="card-link text-light font-weight-bold" href="{{route('page.categories')}}">{{ __('pages.categoriesTitle') }}</a></h5>
        <ul class="list-group list-group-flush">
        	@foreach($productsCategories as $productsCategory)
				<li class="list-group-item p-2 styled-background">
	                <a class="card-link text-dark font-weight-bold" href="{{route('page.category', $productsCategory->id)}}">{{$productsCategory->{'title' . strtoupper(App::getLocale())} }} </a>
	                @if(count($productsCategory->childs))
		                <a class="float-right" data-toggle="collapse" href="#c{{$productsCategory->id}}"><i data-toggle="collapse" class="fas fa-angle-down"></i></a>
		                @include('shared.sidebar-subcategories', ['childs' => $productsCategory->childs, 'idNumber' => $productsCategory->id])
	                @endif
	            </li>
        	@endforeach
        </ul>
    </div>
    <div class="m-2 mb-4 bg-white border border-light shadow rounded">
        <h5 style="background: #5cb85c;" class="text-light font-weight-bold text-uppercase text-center p-4 mb-0 styled-background"><a class="card-link text-light font-weight-bold" href="{{route('page.records')}}">{{ __('pages.recordsTitle') }}</a></h5>
        @foreach($menuRecords as $menuRecord)
            <div class="p-3 border-bottom">
                <a class="card-link" href="{{route('page.record', $menuRecord->id)}}">
                    <img class="img-fluid product-photo img-thumbnail" src="{{$menuRecord->main_photo ? asset($menuRecord->main_photo) : asset('img/common/default.png')}}" alt="{{ $menuRecord->{'title' . strtoupper(App::getLocale())} }}">
                    <h4 class="text-center text-dark font-weight-bold">{{$menuRecord->{'title' . strtoupper(App::getLocale())} }} </h4>
                </a>
            </div>
        @endforeach
    </div>
</div>