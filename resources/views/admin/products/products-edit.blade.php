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
                <div class="py-4 bg-white border rounded border-light shadow">
                    {!! Form::open(['route'=> ['admin.products.update', $product->id], 'autocomplete' => 'off', 'method' => 'put', 'files' => true]) !!}
                        {!! Form::hidden('redirectURL', URL::previous()) !!}
                        <h2 class="text-center font-weight-bold text-uppercase pb-5">Редактировать {{ $product->titleRU }}</h2>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <img class="img-thumbnail img-fluid" src="{{$product->main_photo ? asset($product->main_photo) : asset('img/common/default.png')}}" alt="{{ $product->titleRU }}">
                                    <div class="form-group">
                                        {!! Form::label('main_photo', 'Вибрать главное фото товара:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::file('main_photo', ($errors->has('main_photo') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('main_photo') }}</span>
                                    </div>
                                    @isset($product->main_video)
                                        <video style="width: 100%;" controls>
                                            <source src="{{asset($product->main_video)}}" type="video/{{pathinfo($product->main_video, PATHINFO_EXTENSION)}}">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endisset
                                    <div class="form-group">
                                        {!! Form::label('main_video', 'Вибрать видео товара:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::file('main_video', ($errors->has('main_video') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('main_video') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('youtube', 'Youtube идентификатор:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::text('youtube', $product->youtube, ['placeholder'=>'Youtube идентификатор'] + ($errors->has('youtube') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('youtube') }}</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('price', 'Цена товара:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::number('price', $product->price, ['step'=>'0.01', 'placeholder'=>'Цена товара'] + ($errors->has('price') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('category', 'Вибрать категорию:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::select('category',$categories, $product->category_id, ['placeholder'=>'Вибрать категорию'] + ($errors->has('category') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('category') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('priority', 'Приоритет:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::number('priority', $product->priority, ['placeholder'=>'Приоритет'] + ($errors->has('priority') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('priority') }}</span>
                                    </div>
                                    @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                                        <div class="form-group">
                                            {!! Form::label('title'.strtoupper($code), 'Название товара '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::text('title'.strtoupper($code), $product->{'title'.strtoupper($code)}, ['placeholder'=>'Название товара '.strtoupper($code), 'autofocus' => 'autofocus'] + ($errors->has('title'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('title'.strtoupper($code)) }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('short_description'.strtoupper($code), 'Краткое описание '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::textarea('short_description'.strtoupper($code), $product->{'short_description'.strtoupper($code)}, ['placeholder'=>'Краткое описание '.strtoupper($code)] + ($errors->has('short_description'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('short_description'.strtoupper($code)) }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('titleSEO'.strtoupper($code), 'SEO заголовок '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::text('titleSEO'.strtoupper($code), $product->{'titleSEO'.strtoupper($code)}, ['placeholder'=>'SEO заголовок '.strtoupper($code)] + ($errors->has('titleSEO'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('titleSEO'.strtoupper($code)) }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('descriptionSEO'.strtoupper($code), 'Мета описание '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::textarea('descriptionSEO'.strtoupper($code), $product->{'descriptionSEO'.strtoupper($code)}, ['placeholder'=>'Мета описание '.strtoupper($code)] + ($errors->has('descriptionSEO'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('descriptionSEO'.strtoupper($code)) }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('keywordsSEO'.strtoupper($code), 'Ключевые слова '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::text('keywordsSEO'.strtoupper($code), $product->{'keywordsSEO'.strtoupper($code)}, ['placeholder'=>'Ключевые слова '.strtoupper($code)] + ($errors->has('keywordsSEO'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('keywordsSEO'.strtoupper($code)) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="productAttributes">

                                {{-- {{dd($product->attributesNames()->get())}} --}}

                                @if(!empty(old('attributes_names')) || !empty($product->attributesNames()->get()))
                                    @if(!empty($product->attributesNames()->get()))
                                        @php $i = 0; $k = 0; $previous = []; $attributesNamesOrderedArray = $product->attributesNames()->orderBy('nameRU')->get(); @endphp
                                        {{-- {{dd($attributesNamesOrderedArray)}} --}}
                                        @for($i; $i < count($attributesNamesOrderedArray); $i++)
                                            <div class="existed-attributes form-group py-4 border-bottom" id="attribute{{$i+1}}">
                                                <div class="row">
                                                    <p class="text-uppercase font-weight-bold col-12 col-sm-6">Характеристика {{$i+1}}</p>
                                                    
                                                    @if($previous == $attributesNamesOrderedArray[$i]->nameRU)
                                                        @php $k++; @endphp
                                                    @else
                                                        @php $k=0; @endphp
                                                    @endif
                                                    @php $previous = $attributesNamesOrderedArray[$i]->nameRU @endphp

                                                    {{-- @if(count($attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get()) > 1)
                                                        @php 
                                                            foreach ($attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get() as $value) {
                                                                if (in_array($value, $previous)) {
                                                                    $k++;
                                                                }
                                                            }
                                                            $previous[] = $attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get()[$k]->{'value'.strtoupper($code)}
                                                        @endphp
                                                    @else
                                                        @php $k=0; @endphp
                                                    @endif --}}



                                                   {{-- {{dd($attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get())}} --}}
                                                    {{-- {{dd($attributesNamesOrderedArray)}} --}}
                                                    {{-- {{dd($attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get()[count($attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get())-1]->id)}} --}}


                                                    <div class="col-12 col-sm-6">
                                                        {{-- <a class="float-right btn btn-danger text-uppercase font-weight-bold" onclick="return confirm('Подтвердить удаление?')" href="{{route('admin.products.productAttributeDestroy', [$product->id, $attributesNamesOrderedArray[$i]->id, $attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get()[$k]->id])}}">Удалить</a> --}}



                                                        <a class="float-right btn btn-danger text-uppercase font-weight-bold" onclick="return confirm('Подтвердить удаление?')" href="{{route('admin.products.productAttributeDestroy', [$product->id, $attributesNamesOrderedArray[$i]->id, $attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get()[count($attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get())-1]->id])}}">Удалить</a>
                                                    </div>

                                                </div>



                                                <div class="row">
                                                    <div class="col-12 col-sm-6 py-2">
                                                        <label class="text-uppercase font-weight-bold col-12" for="attribute_priority_{{$i+1}}">Приоритет характеристики:</label>
                                                        <input type="number" id="attribute_priority_{{$i+1}}" name="attribute_priority_{{$i+1}}" placeholder="Приоритет характеристики" 
                                                        @if($errors->has('attribute_priority_'.$i)) class="form-control is-invalid" 
                                                        @else class="form-control"
                                                        @endif 
                                                        value="{{old('attribute_priority_'.$i) ?: $attributesNamesOrderedArray[$i]->pivot->priority}}">
                                                        <span class="text-danger">{{ $errors->first('attribute_priority_'.$i) }}</span>
                                                    </div>
                                                </div>



                                                @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6 py-2">
                                                            <label class="text-uppercase font-weight-bold col-12" for="attribute_name_{{strtoupper($code)}}_{{$i+1}}">Название {{strtoupper($code)}}:</label>
                                                            <input type="text" id="attribute_name_{{strtoupper($code)}}_{{$i+1}}" name="attributes_names{{strtoupper($code)}}[]" placeholder="Название {{strtoupper($code)}}" 
                                                            @if($errors->has('attributes_names_'.strtoupper($code).'_'.$i)) class="form-control autocomplete-list-target-name{{strtoupper($code)}} is-invalid" 
                                                            @else class="form-control autocomplete-list-target-name{{strtoupper($code)}}"
                                                            @endif 
                                                            value="{{old('attributes_names'.strtoupper($code).'.'.$i) ?: $attributesNamesOrderedArray[$i]->{'name'.strtoupper($code)} }}">
                                                            <span class="text-danger">{{ $errors->first('attributes_names_'.strtoupper($code).'_'.$i) }}</span>
                                                        </div>
                                                        <div class="col-12 col-sm-6 py-2">
                                                            <label class="text-uppercase font-weight-bold col-12" for="attribute_value_{{strtoupper($code)}}_{{$i+1}}">Значение {{strtoupper($code)}}:</label>
                                                            <input type="text" id="attribute_value_{{strtoupper($code)}}_{{$i+1}}" name="attributes_values{{strtoupper($code)}}[]" placeholder="Значение {{strtoupper($code)}}" 
                                                            @if($errors->has('attributes_values_'.strtoupper($code).'_'.$i)) class="form-control autocomplete-list-target-value{{strtoupper($code)}} is-invalid"
                                                            @else class="form-control autocomplete-list-target-value{{strtoupper($code)}}"
                                                            @endif

                                                            {{-- value="{{old('attributes_values'.strtoupper($code).'.'.$i) ?: $attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get()[$k]->{'value'.strtoupper($code)} }} --}}





                                                            value="{{old('attributes_values'.strtoupper($code).'.'.$i) ?: $attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get()[count($attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get())-1]->{'value'.strtoupper($code)} }}">





                                                            {{-- {{dd($attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get()[count($attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get())-1])}} --}}

                                                            <span class="text-danger">{{ $errors->first('attributes_values_'.strtoupper($code).'_'.$i) }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>                                            
                                        @endfor
                                    @endif
                                    @if(!empty(old('attributes_namesRU')))
                                        @for($i; $i < count(old('attributes_namesRU')); $i++)
                                            <div class="existed-attributes form-group py-4 border-bottom" id="attribute{{$i+1}}">
                                                <div class="row">
                                                    <p class="text-uppercase font-weight-bold col-12 col-sm-6">Характеристика {{$i+1}}</p>
                                                    <div class="col-12 col-sm-6">
                                                        <a class="float-right btn btn-danger text-uppercase font-weight-bold" onclick="deleteAttribute('attribute{{$i+1}}')" href="javascript:void(0)">Удалить</a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-sm-6 py-2">
                                                        <label class="text-uppercase font-weight-bold col-12" for="attribute_priority_{{$i+1}}">Приоритет характеристики:</label>
                                                        <input type="number" id="attribute_priority_{{$i+1}}" name="attribute_priority_{{$i+1}}" placeholder="Приоритет характеристики" 
                                                        @if($errors->has('attribute_priority_'.$i)) class="form-control is-invalid" 
                                                        @else class="form-control"
                                                        @endif 
                                                        value="{{old('attribute_priority_'.$i)}}">
                                                        <span class="text-danger">{{ $errors->first('attribute_priority_'.$i) }}</span>
                                                    </div>
                                                </div>
                                                @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6 py-2">
                                                            <label class="text-uppercase font-weight-bold col-12" for="attribute_name_{{strtoupper($code)}}_{{$i+1}}">Название {{strtoupper($code)}}:</label>
                                                            <input type="text" id="attribute_name_{{strtoupper($code)}}_{{$i+1}}" name="attributes_names{{strtoupper($code)}}[]" placeholder="Название {{strtoupper($code)}}" 
                                                            @if($errors->has('attributes_names'.strtoupper($code).'.'.$i)) class="form-control autocomplete-list-target-name{{strtoupper($code)}} is-invalid" 
                                                            @else class="form-control autocomplete-list-target-name{{strtoupper($code)}}"
                                                            @endif 
                                                            value="{{old('attributes_names'.strtoupper($code).'.'.$i)}}">
                                                            <span class="text-danger">{{ $errors->first('attributes_names'.strtoupper($code).'.'.$i) }}</span>
                                                        </div>
                                                        <div class="col-12 col-sm-6 py-2">
                                                            <label class="text-uppercase font-weight-bold col-12" for="attribute_value_{{strtoupper($code)}}_{{$i+1}}">Значение {{strtoupper($code)}}:</label>
                                                            <input type="text" id="attribute_value_{{strtoupper($code)}}_{{$i+1}}" name="attributes_values{{strtoupper($code)}}[]" placeholder="Значение {{strtoupper($code)}}" 
                                                            @if($errors->has('attributes_values'.strtoupper($code).'.'.$i)) class="form-control autocomplete-list-target-value{{strtoupper($code)}} is-invalid"
                                                            @else class="form-control autocomplete-list-target-value{{strtoupper($code)}}"
                                                            @endif
                                                            value="{{old('attributes_values'.strtoupper($code).'.'.$i)}}">
                                                            <span class="text-danger">{{ $errors->first('attributes_values'.strtoupper($code).'.'.$i) }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endfor
                                    @endif
                                @endif

                            </div>
                            <button id="add-new-attribute" type="button" class="btn btn-primary w-100 my-4 text-uppercase font-weight-bold" onclick="addNewAttribute()">Добавить характеристику товара</button>
                            @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                                <div class="form-group">
                                    {!! Form::label('description'.strtoupper($code), 'Основная часть '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                    {!! Form::textarea('description'.strtoupper($code), $product->{'description'.strtoupper($code)}, ($errors->has('description'.strtoupper($code)) ? ['class'=>'form-control is-invalid editor'] : ['class'=>'form-control editor'])) !!}
                                    <span class="text-danger">{{ $errors->first('description'.strtoupper($code)) }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-6 m-auto">
                            {!! Form::submit('Сохранить', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
                        </div>
                    {!! Form::close() !!}
                    {!! Form::open(['route'=> ['admin.products.destroy', $product->id], 'method' => 'delete', 'class' => 'mt-3', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}
                        <div class="col-md-6 m-auto">
                            {!! Form::submit('Удалить', ['class'=>'btn btn-danger w-100 text-uppercase font-weight-bold']) !!}
                        </div>
                    {!! Form::close() !!}
                    <div class="mt-3">
                        <div class="col-md-6 m-auto">
                            <a class="btn btn-warning w-100 text-uppercase font-weight-bold" href="{{route('admin.products.copy', [$product->id, Crypt::encrypt(URL::previous())])}}">Копировать</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    var attributesNamesArray = new Map();
    var attributesValuesArray = new Map();  
    @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
        attributesNamesArray.set("{{strtoupper($code)}}",{!! json_encode($attributesNamesArray[strtoupper($code)]) !!});
        attributesValuesArray.set("{{strtoupper($code)}}",{!! json_encode($attributesValuesArray[strtoupper($code)]) !!});
    @endforeach
    var languages = {!! json_encode(LaravelLocalization::getLocalesOrder()) !!}
</script>
<script src="{{ asset('js/products-attributes-autocomplete.js') }}"></script>
<script src="{{ asset('js/products-add-new-attributes.js') }}"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replaceClass = 'editor';
</script>
@endsection