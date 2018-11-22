@extends('layouts.app')

@section('content')
<link href="{{ asset('css/products-attributes-autocomplete.css') }}" rel="stylesheet">
<main>
    <div class="container">
        <div class="row justify-content-center">
            @include('admin.shared.sidebar')
            <div class="col-12 col-md-9 p-4">
                @if (session('message'))
                    <div class="alert alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('message') }}</strong>
                    </div>
                @endif
                <div class="container-fluid py-4 bg-white border rounded border-light shadow">
                    <h2 class="text-center font-weight-bold text-uppercase">Добавить товар</h2>
                    {!! Form::open(['route'=>'admin.products.store', 'autocomplete' => 'off', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('price', 'Цена товара:', ['class' => 'text-uppercase font-weight-bold']) !!}
                            {!! Form::number('price', old('price'), ['step'=>'0.01', 'placeholder'=>'Цена товара'] + ($errors->has('price') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        </div>
                        <div class="form-group">
                            {!! Form::label('category', 'Категория:', ['class' => 'text-uppercase font-weight-bold']) !!}
                            {!! Form::select('category', $categories, old('category'), ['placeholder'=>'Вибрать категорию'] + ($errors->has('category') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                            <span class="text-danger">{{ $errors->first('category') }}</span>
                        </div>
                        <div class="form-group">
                            {!! Form::label('priority', 'Приоритет:', ['class' => 'text-uppercase font-weight-bold']) !!}
                            {!! Form::number('priority', old('priority'), ['placeholder'=>'Приоритет'] + ($errors->has('priority') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                            <span class="text-danger">{{ $errors->first('priority') }}</span>
                        </div>
                        <div class="form-group">
                            {!! Form::label('main_photo', 'Вибрать главное фото товара:', ['class' => 'text-uppercase font-weight-bold']) !!}
                            {!! Form::file('main_photo', ($errors->has('main_photo') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                            <span class="text-danger">{{ $errors->first('main_photo') }}</span>
                        </div>
                        {{-- {{dd($errors)}} --}}
                        @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                            <div class="form-group">
                                {!! Form::label('title'.strtoupper($code), 'Название товара '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                {!! Form::text('title'.strtoupper($code), old('title'.strtoupper($code)), ['placeholder'=>'Название товара '.strtoupper($code)] + ($errors->has('title'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                <span class="text-danger">{{ $errors->first('title'.strtoupper($code)) }}</span>
                            </div>
                            <div class="form-group">
                                {!! Form::label('short_description'.strtoupper($code), 'Краткое описание '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                {!! Form::textarea('short_description'.strtoupper($code), old('short_description'.strtoupper($code)), ['placeholder' => 'Краткое описание '.strtoupper($code)] + ($errors->has('short_description'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                <span class="text-danger">{{ $errors->first('short_description'.strtoupper($code)) }}</span>
                            </div>
                            <div class="form-group">
                                {!! Form::label('description'.strtoupper($code), 'Основная часть '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                {!! Form::textarea('description'.strtoupper($code), old('description'.strtoupper($code)), ($errors->has('description'.strtoupper($code)) ? ['class'=>'form-control is-invalid editor'] : ['class'=>'form-control editor'])) !!}
                                <span class="text-danger">{{ $errors->first('description'.strtoupper($code)) }}</span>
                            </div>
                            <div class="form-group">
                                {!! Form::label('titleSEO'.strtoupper($code), 'SEO заголовок '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                {!! Form::text('titleSEO'.strtoupper($code), old('titleSEO'.strtoupper($code)), ['placeholder'=>'SEO заголовок '.strtoupper($code)] + ($errors->has('titleSEO'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                <span class="text-danger">{{ $errors->first('titleSEO'.strtoupper($code)) }}</span>
                            </div>
                            <div class="form-group">
                                {!! Form::label('descriptionSEO'.strtoupper($code), 'Мета описание '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                {!! Form::textarea('descriptionSEO'.strtoupper($code), old('descriptionSEO'.strtoupper($code)), ['placeholder'=>'Мета описание '.strtoupper($code)] + ($errors->has('descriptionSEO'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                <span class="text-danger">{{ $errors->first('descriptionSEO'.strtoupper($code)) }}</span>
                            </div>
                            <div class="form-group">
                                {!! Form::label('keywordsSEO'.strtoupper($code), 'Ключевые слова '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                {!! Form::text('keywordsSEO'.strtoupper($code), old('keywordsSEO'.strtoupper($code)), ['placeholder'=>'Ключевые слова '.strtoupper($code)] + ($errors->has('keywordsSEO'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                <span class="text-danger">{{ $errors->first('keywordsSEO'.strtoupper($code)) }}</span>
                            </div>
                        @endforeach
                        <div id="productAttributes">
                            @if(!empty(old('attributes_names')))
                                @for($i = 0; $i < count(old('attributes_names')); $i++)
                                    <div class="existed-attributes form-group py-4 border-bottom" id="attribute{{$i+1}}">
                                        <div class="row">
                                            <p class="text-uppercase font-weight-bold col-12 col-sm-6">Характеристика {{$i+1}}</p>
                                            <div class="col-12 col-sm-6">
                                                <a class="float-right btn btn-danger text-uppercase font-weight-bold" onclick="deleteAttribute('attribute{{$i+1}}')" href="javascript:void(0)">Удалить</a>
                                            </div>
                                        </div>
                                        @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                                            <div class="row">
                                                <div class="col-12 col-sm-6 py-2">
                                                    <label class="text-uppercase font-weight-bold col-12" for="attribute_name_{{strtoupper($code)}}_{{$i+1}}">Название {{strtoupper($code)}}:</label>
                                                    <input type="text" id="attribute_name_{{strtoupper($code)}}_{{$i+1}}" name="attributes_names_{{strtoupper($code)}}[]" placeholder="Название {{strtoupper($code)}}" 
                                                    @if($errors->has('attributes_names_'.strtoupper($code).'_'.$i)) class="form-control autocomplete-list-target-name is-invalid" 
                                                    @else class="form-control autocomplete-list-target-name"
                                                    @endif 
                                                    value="{{old('attributes_names_'.strtoupper($code).'_'.$i)}}">
                                                    <span class="text-danger">{{ $errors->first('attributes_names_'.strtoupper($code).'_'.$i) }}</span>
                                                </div>
                                                <div class="col-12 col-sm-6 py-2">
                                                    <label class="text-uppercase font-weight-bold col-12" for="attribute_value_{{strtoupper($code)}}_{{$i+1}}">Значение {{strtoupper($code)}}:</label>
                                                    <input type="text" id="attribute_value_{{strtoupper($code)}}_{{$i+1}}" name="attributes_values_{{strtoupper($code)}}[]" placeholder="Значение {{strtoupper($code)}}" 
                                                    @if($errors->has('attributes_values_'.strtoupper($code).'_'.$i)) class="form-control autocomplete-list-target-value is-invalid"
                                                    @else class="form-control autocomplete-list-target-value"
                                                    @endif
                                                    value="{{old('attributes_values_'.strtoupper($code).'_'.$i)}}">
                                                    <span class="text-danger">{{ $errors->first('attributes_values_'.strtoupper($code).'_'.$i) }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endfor
                            @endif
                        </div>
                        <button id="add-new-attribute" type="button" class="btn btn-primary w-100 my-4 text-uppercase font-weight-bold" onclick="addNewAttribute()">Добавить характеристику товара</button>
                        <div class="form-group">
                            {!! Form::submit('Добавить товар', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>             
            </div>
        </div>
    </div>
</main>
<script>
    var attributesNamesArray = {!! json_encode($attributesNamesArray) !!};
    var attributesValuesArray = {!! json_encode($attributesValuesArray) !!};
    var languages = {!! json_encode(LaravelLocalization::getLocalesOrder()) !!}
</script>
<script src="{{ asset('js/products-attributes-autocomplete.js') }}"></script>
<script src="{{ asset('js/products-add-new-attributes.js') }}"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replaceClass = 'editor';
</script>
@endsection