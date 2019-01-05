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
                    {!! Form::open(['route'=> ['admin.services.update', $service->id], 'method' => 'put', 'files' => true]) !!}
                        <h2 class="text-center font-weight-bold text-uppercase pb-5">Редактировать {{ $service->titleRU }}</h2>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <img class="img-thumbnail img-fluid" src="{{$service->main_photo ? asset($service->main_photo) : asset('img/common/default.png')}}" alt="{{ $service->titleRU }}">
                                    <div class="form-group">
                                        {!! Form::label('main_photo', 'Вибрать главное фото услуги:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::file('main_photo', ($errors->has('main_photo') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('main_photo') }}</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                                        <div class="form-group">
                                            {!! Form::label('title'.strtoupper($code), 'Название услуги '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::text('title'.strtoupper($code), $service->{'title'.strtoupper($code)}, ['placeholder'=>'Название услуги '.strtoupper($code), 'autofocus' => 'autofocus'] + ($errors->has('title'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('title'.strtoupper($code)) }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('short_description'.strtoupper($code), 'Краткое описание '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::textarea('short_description'.strtoupper($code), $service->{'short_description'.strtoupper($code)}, ['placeholder'=>'Краткое описание '.strtoupper($code)] + ($errors->has('short_description'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('short_description'.strtoupper($code)) }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('titleSEO'.strtoupper($code), 'SEO заголовок '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::text('titleSEO'.strtoupper($code), $service->{'titleSEO'.strtoupper($code)}, ['placeholder'=>'SEO заголовок '.strtoupper($code)] + ($errors->has('titleSEO'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('titleSEO'.strtoupper($code)) }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('descriptionSEO'.strtoupper($code), 'Мета описание '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::textarea('descriptionSEO'.strtoupper($code), $service->{'descriptionSEO'.strtoupper($code)}, ['placeholder'=>'Мета описание '.strtoupper($code)] + ($errors->has('descriptionSEO'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('descriptionSEO'.strtoupper($code)) }}</span>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('keywordsSEO'.strtoupper($code), 'Ключевые слова '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::text('keywordsSEO'.strtoupper($code), $service->{'keywordsSEO'.strtoupper($code)}, ['placeholder'=>'Ключевые слова '.strtoupper($code)] + ($errors->has('keywordsSEO') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('keywordsSEO'.strtoupper($code)) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                                <div class="form-group">
                                    {!! Form::label('description'.strtoupper($code), 'Основная часть '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                    {!! Form::textarea('description'.strtoupper($code), $service->{'description'.strtoupper($code)}, ($errors->has('description'.strtoupper($code)) ? ['class'=>'form-control is-invalid editor'] : ['class'=>'form-control editor'])) !!}
                                    <span class="text-danger">{{ $errors->first('description'.strtoupper($code)) }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-6 m-auto">
                            {!! Form::submit('Сохранить', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
                        </div>
                    {!! Form::close() !!}
                    {!! Form::open(['route'=> ['admin.services.destroy', $service->id], 'method' => 'delete', 'class' => 'mt-3', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}
                        <div class="col-md-6 m-auto">
                            {!! Form::submit('Удалить', ['class'=>'btn btn-danger w-100 text-uppercase font-weight-bold']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</main>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replaceClass = 'editor';
</script>
@endsection