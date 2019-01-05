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
                    {!! Form::open(['route'=> ['admin.pages.'.$route, $page->id], 'method' => 'put']) !!}
                        <h2 class="text-center font-weight-bold text-uppercase pb-5">Редактировать {{ $page->page }}</h2>
                        <div class="container-fluid">
                            @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                                <div class="form-group">
                                    {!! Form::label('description'.strtoupper($code), 'Контент страницы '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                    {!! Form::textarea('description'.strtoupper($code), $page->{'description'.strtoupper($code)}, ($errors->has('description'.strtoupper($code)) ? ['class'=>'form-control is-invalid editor'] : ['class'=>'form-control editor'])) !!}
                                    <span class="text-danger">{{ $errors->first('description'.strtoupper($code)) }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-6 m-auto">
                            {!! Form::submit('Сохранить', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
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