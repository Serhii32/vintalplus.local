@extends('shared.master')
@section('content')
<div class="container" style="min-height: 50vh">
	<div class="row">
		@include('shared.sidebar')
		<div class="col-12 col-md-8 col-lg-9">
			<h3 class="text-dark font-weight-bold text-uppercase text-center p-4">{{$product->{'title' . strtoupper(App::getLocale())} }}</h3>
			<div class="container">
				<div class="row justify-content-center px-4">

                <style>
                    #zoomImg {
                        border-radius: 5px;
                        cursor: pointer;
                        transition: 0.3s;
                    }

                    #zoomImg:hover {opacity: 0.7;}

                    
                    .zoomImageModal {
                        display: none; 
                        position: fixed; 
                        z-index: 100; 
                        padding-top: 100px; 
                        left: 0;
                        top: 0;
                        width: 100%; 
                        height: 100%; 
                        overflow: auto; 
                        background-color: rgb(0,0,0);
                        background-color: rgba(0,0,0,0.9);
                    }

                    .zoomImageModalContent {
                        margin: auto;
                        display: block;
                        width: 80%;
                        max-width: 700px;
                    }

                    #zoomImageCaption {
                        margin: auto;
                        display: block;
                        width: 80%;
                        max-width: 700px;
                        text-align: center;
                        color: #ccc;
                        padding: 10px 0;
                        height: 150px;
                    }

                    .zoomImageModalContent, #zoomImageCaption {    
                        -webkit-animation-name: zoom;
                        -webkit-animation-duration: 0.6s;
                        animation-name: zoom;
                        animation-duration: 0.6s;
                    }

                    @-webkit-keyframes zoom {
                        from {-webkit-transform:scale(0)} 
                        to {-webkit-transform:scale(1)}
                    }

                    @keyframes zoom {
                        from {transform:scale(0)} 
                        to {transform:scale(1)}
                    }

                    .zoomImageClose {
                        position: absolute;
                        top: 15px;
                        right: 35px;
                        color: #f1f1f1;
                        font-size: 40px;
                        font-weight: bold;
                        transition: 0.3s;
                    }

                    .zoomImageClose:hover,
                    .zoomImageClose:focus {
                        color: #bbb;
                        text-decoration: none;
                        cursor: pointer;
                    }

                    @media only screen and (max-width: 700px){
                        .zoomImageModalContent {
                            width: 100%;
                        }
                    }
                    </style>

                    <div class="col-12 col-md-6 my-3 card h-100 shadow p-2">
                        <img id="zoomImg" class="img-fluid img-thumbnail" src="{{$product->main_photo ? asset($product->main_photo) : asset('img/common/default.png')}}" alt="{{ $product->{'title' . strtoupper(App::getLocale())} }}">
                    </div>


                    <div id="zoomImageModal" class="zoomImageModal">
                        <span class="zoomImageClose">&times;</span>
                        <img class="zoomImageModalContent" id="zoomImageModalContent" src="{{$product->main_photo ? asset($product->main_photo) : asset('img/common/default.png')}}" alt="{{ $product->{'title' . strtoupper(App::getLocale())} }}">
                        <div id="zoomImageCaption"></div>
                    </div>

                    <script>
                        var zoomImageModal = document.getElementById('zoomImageModal');
                        var zoomImg = document.getElementById('zoomImg');
                        var zoomImageModalContent = document.getElementById("zoomImageModalContent");
                        var zoomImageCaption = document.getElementById("zoomImageCaption");
                        zoomImg.onclick = function(){
                            zoomImageModal.style.display = "block";
                            zoomImg.src = this.src;
                            zoomImageCaption.innerHTML = this.alt;
                        }
                        var zoomImageClose = document.getElementsByClassName("zoomImageClose")[0];
                        zoomImageClose.onclick = function() { 
                            zoomImageModal.style.display = "none";
                        }
                    </script>


                    <div class="col-12 col-md-6 my-3">
                        <h4 class="text-center">{{$product->{'title' . strtoupper(App::getLocale())} }}</h4>
                        <h5 class="text-left text-secondary">{{ __('pages.price') }}: {{ number_format($product->price, 2, '.', ' ') }} {{ __('pages.uah') }}</h5>
                        <input id="order-button" style="min-width: 120px;" onclick="showModal({{$product->id}})" class="btn btn-success mb-0 w-50 mt-auto mx-auto text-uppercase font-weight-bold" type="submit" value="Заказать">
                        <p class="text-justify text-secondary" style="font-size: 20px;">{{$product->{'short_description' . strtoupper(App::getLocale())} }}</p>
                    </div>
                </div>
                @isset($product->main_video)
                    <video style="width: 100%;" controls>
                        <source src="{{asset($product->main_video)}}" type="video/{{pathinfo($product->main_video, PATHINFO_EXTENSION)}}">
                        Your browser does not support the video tag.
                    </video>
                @endisset
                @isset($product->youtube) 
                    <iframe style="border:none; width: 100%; height: 450px;" src="https://www.youtube.com/embed/{{$product->youtube}}"></iframe>
                @endisset
                @if(!empty($product->attributesNames()->first()))
                	<h4 class="text-center">{{ __('pages.productAttributes') }}</h4>

                    @php $k = 0; $previous = ''; $attributesNamesOrderedArray = $product->attributesNames()->orderBy('name'.strtoupper(App::getLocale()))->get(); @endphp
                    @for($i=0; $i < count($attributesNamesOrderedArray); $i++)

                        @if($previous == $attributesNamesOrderedArray[$i]->{'name' . strtoupper(App::getLocale())} )
                            @php $k++; @endphp
                        @else
                            @php $k=0; @endphp
                        @endif
                        @php $previous = $attributesNamesOrderedArray[$i]->{'name' . strtoupper(App::getLocale())} @endphp

                        <div class="row mx-2">
                            <div class="col-12 col-sm-6 py-2 border">
                                <p class="text-uppercase font-weight-bold col-12 mb-0">{{$attributesNamesOrderedArray[$i]->{'name' . strtoupper(App::getLocale())} }}</p>
                            </div>
                            <div class="col-12 col-sm-6 py-2 border">
                                <p class="text-uppercase font-weight-bold col-12 mb-0">{{$attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get()[$k]->{'value' . strtoupper(App::getLocale())} }}</p>
                            </div>
                        </div>
                    @endfor
                @endif
                <div class="text-secondary item-description m-2" style="font-size: 20px;">
                	{!! $product->{'description' . strtoupper(App::getLocale())} !!}
                </div>
			</div>
            @if(count($categoryProducts))
                <div class="my-5">
                    <link href="{{asset('/css/flickity.min.css')}}" rel="stylesheet">
                    <script src="{{asset('/js/flickity.pkgd.min.js')}}"></script>
                    <h3 style="border-bottom: 5px #5cb85c solid; border-radius: 5px;" class="text-dark font-weight-bold text-uppercase text-center pt-4">{{ __('pages.similarProducts') }}</h3>
                    <div class="main-carousel" data-flickity='{ "imagesLoaded": true, "draggable": false, "percentPosition": true, "autoPlay": 2000, "wrapAround": true }'>
                        @foreach($categoryProducts as $categoryProduct)
                            <div class="carousel-cell" style="background: transparent; width: 33%;">
                                <a class="card-link text-dark" href="{{route('page.product', $categoryProduct->id)}}">
                                    <img style="display: block; margin: auto; height: 300px; /*object-fit: cover;*/ width: 100%;" src="{{$categoryProduct->main_photo ? asset($categoryProduct->main_photo) : asset('img/common/default.png')}}" alt="{{ $categoryProduct->{'title' . strtoupper(App::getLocale())} }}" src="{{asset('img/common/default.png') }}">
                                    <h3 class="text-center text-uppercase font-weight-bold">{{ $categoryProduct->{'title' . strtoupper(App::getLocale())} }}</h3>
                                </a>
                            </div>
                         @endforeach
                    </div>
                </div>
            @endif
            @include('shared.order-form')
		</div>
	</div>
</div>
@endsection