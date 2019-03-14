@extends('layouts.app')

@section('content')
<link href="{{ asset('css/products-attributes-autocomplete.css') }}" rel="stylesheet">
<main>
    <div class="container">
        <div class="row justify-content-center">
            @include('admin.shared.sidebar')
            <div class="col-12 col-md-9 p-4">
                <product-create-component :categories="{{json_encode($categories)}}" :localizations="{{json_encode($localizations)}}"></product-create-component>           
            </div>
        </div>
    </div>
</main>

@endsection