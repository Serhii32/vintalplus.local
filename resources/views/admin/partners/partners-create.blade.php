@extends('layouts.app')

@section('content')
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
                    <h2 class="text-center font-weight-bold text-uppercase">Добавить партнера</h2>
                    {!! Form::open(['route'=>'admin.partners.store', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('main_photo', 'Вибрати главное фото партнера:', ['class' => 'text-uppercase font-weight-bold']) !!}
                            {!! Form::file('main_photo', ($errors->has('main_photo') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                            <span class="text-danger">{{ $errors->first('main_photo') }}</span>
                        </div>
                        @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                            <div class="form-group">
                                {!! Form::label('title'.strtoupper($code), 'Название партнера '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                {!! Form::text('title'.strtoupper($code), old('title'.strtoupper($code)), ['placeholder'=>'Название партнера '.strtoupper($code)] + ($errors->has('title'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                <span class="text-danger">{{ $errors->first('title'.strtoupper($code)) }}</span>
                            </div>
                        @endforeach
                        <div class="form-group">
                            {!! Form::submit('Добавить партнера', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
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