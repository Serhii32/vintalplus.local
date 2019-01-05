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
                    {!! Form::open(['route'=> ['admin.partners.update', $partner->id], 'method' => 'put', 'files' => true]) !!}
                        <h2 class="text-center font-weight-bold text-uppercase pb-5">Редактировать {{ $partner->titleRU }}</h2>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <img class="img-thumbnail img-fluid" src="{{$partner->main_photo ? asset($partner->main_photo) : asset('img/common/default.png')}}" alt="{{ $partner->titleRU }}">
                                    <div class="form-group">
                                        {!! Form::label('main_photo', 'Вибрать главное фото партнера:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::file('main_photo', ($errors->has('main_photo') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('main_photo') }}</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                                        <div class="form-group">
                                            {!! Form::label('title'.strtoupper($code), 'Название партнера '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                            {!! Form::text('title'.strtoupper($code), $partner->{'title'.strtoupper($code)}, ['placeholder'=>'Название партнера '.strtoupper($code), 'autofocus' => 'autofocus'] + ($errors->has('title'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                            <span class="text-danger">{{ $errors->first('title'.strtoupper($code)) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-auto">
                            {!! Form::submit('Сохранить', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
                        </div>
                    {!! Form::close() !!}
                    {!! Form::open(['route'=> ['admin.partners.destroy', $partner->id], 'method' => 'delete', 'class' => 'mt-3', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}
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