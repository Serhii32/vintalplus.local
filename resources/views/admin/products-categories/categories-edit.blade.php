@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            @include('admin.shared.sidebar')
            <div class="col-12 col-md-9 p-2">
                @if (session('message'))
                    <div class="alert alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('message') }}</strong>
                    </div>
                @endif
                <div class="py-4 bg-white border rounded border-light shadow">
                    {!! Form::open(['route'=> ['admin.productsCategories.update', $category->id], 'method' => 'put', 'files' => true]) !!}
                        <h2 class="text-center font-weight-bold text-uppercase pb-5">Редактировать {{ $category->titleRU }}</h2>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <img class="img-thumbnail img-fluid" src="{{$category->photo ? asset($category->photo) : asset('img/common/default.png')}}" alt="{{ $category->titleRU }}">
                                    <div class="form-group">
                                        {!! Form::label('photo', 'Вибрать фото категории:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::file('photo', ($errors->has('photo') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('priority', 'Приоритет:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::number('priority', $category->priority, ['placeholder'=>'Приоритет'] + ($errors->has('priority') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('priority') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('parent_id', 'Родительськая категория:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::select('parent_id',$allCategories, $category->parent_id, ['placeholder'=>'Вибрать категорию'] + ($errors->has('parent_id') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                                    </div>
                                    @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                                        <div class="form-group">
                                            {!! Form::label('title'.strtoupper($code), 'Название категории '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::text('title'.strtoupper($code), $category->{'title'.strtoupper($code)}, ['placeholder'=>'Название категории '.strtoupper($code), 'autofocus' => 'autofocus'] + ($errors->has('title'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('title'.strtoupper($code)) }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('short_description'.strtoupper($code), 'Краткое описание '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::textarea('short_description'.strtoupper($code), $category->{'short_description'.strtoupper($code)}, ['placeholder'=>'Краткое описание '.strtoupper($code)] + ($errors->has('short_description'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('short_description'.strtoupper($code)) }}</span>
                                        </div>
                                         <div class="form-group">
                                            {!! Form::label('titleSEO'.strtoupper($code), 'SEO заголовок '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::text('titleSEO'.strtoupper($code), $category->{'titleSEO'.strtoupper($code)}, ['placeholder'=>'SEO заголовок '.strtoupper($code)] + ($errors->has('titleSEO'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('titleSEO'.strtoupper($code)) }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('descriptionSEO'.strtoupper($code), 'Мета описание '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::textarea('descriptionSEO'.strtoupper($code), $category->{'descriptionSEO'.strtoupper($code)}, ['placeholder'=>'Мета описание '.strtoupper($code)] + ($errors->has('descriptionSEO'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('descriptionSEO'.strtoupper($code)) }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('keywordsSEO'.strtoupper($code), 'Ключевые слова '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::text('keywordsSEO'.strtoupper($code), $category->{'keywordsSEO'.strtoupper($code)}, ['placeholder'=>'Ключевые слова '.strtoupper($code)] + ($errors->has('keywordsSEO'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('keywordsSEO'.strtoupper($code)) }}</span>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-auto">
                            {!! Form::submit('Сохранить', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
                        </div>
                    {!! Form::close() !!}
                    {!! Form::open(['route'=> ['admin.productsCategories.destroy', $category->id], 'method' => 'delete', 'class' => 'mt-3', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}
                        <div class="col-md-6 m-auto">
                            {!! Form::submit('Удалить', ['class'=>'btn btn-danger w-100 text-uppercase font-weight-bold']) !!}
                        </div>
                    {!! Form::close() !!}
                    @if(count($products))
                        <h3 class="text-center font-weight-bold text-uppercase p-2 mt-5">Товары в данной категории</h3>
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                @foreach($products as $product)
                                    {!! Form::open(['route'=> ['admin.productsCategories.removeProductFromCategory', $product->id], 'method' => 'delete', 'class' => 'col-12 col-sm-6 col-md-4 col-lg-3 my-3', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}
                                        <div class="card h-100 shadow p-2">
                                            <a class="card-link text-secondary p-1" href="{{route('admin.products.edit', $product->id)}}">
                                                <div class="text-center"><img class="img-fluid img-thumbnail" src="{{$product->main_photo ? asset($product->main_photo) : asset('img/common/default.png')}}" alt="{{$product->titleRU}}"></div>
                                                <h4 class="text-center text-uppercase">{{$product->titleRU}}</h4>
                                            </a>
                                            {!! Form::submit('Удалить', ['class'=>'btn btn-danger mb-0 mt-auto mx-auto w-75 text-uppercase font-weight-bold']) !!}
                                        </div>
                                    {!! Form::close() !!}
                                @endforeach
                            </div>
                            <div class="custom-links py-4">{{$products->links()}}</div>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection