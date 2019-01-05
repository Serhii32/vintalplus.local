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
                <div class="container-fluid py-4 bg-white border rounded border-light shadow">
                    <h2 class="text-center font-weight-bold text-uppercase pb-4">Добавить {{$attributeTitleValue}} характеристики товара</h2>
                    <div class="container-fluid">
                        <div class="row">
                            {!! Form::open(['route'=>['admin.attributes.store', $identificator.'=1'], 'class'=>'w-100 mb-3']) !!}
                                @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                                    <div class="form-group">
                                        {!! Form::label($identificator.strtoupper($code), 'Название характеристики '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::text($identificator.strtoupper($code), old($identificator.strtoupper($code)), ['placeholder'=>'Название характеристики '.strtoupper($code), 'autofocus' => 'autofocus'] + ($errors->has($identificator.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first($identificator.strtoupper($code)) }}</span>
                                    </div>
                                @endforeach
                                {!! Form::submit('Сохранить', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection