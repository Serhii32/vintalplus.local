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
                    {!! Form::open(['route'=> 'admin.pagesSEO.update', 'method' => 'put']) !!}
                        <h2 class="text-center font-weight-bold text-uppercase pb-5">SEO характеристика страниц</h2>
                        <div class="container-fluid">
                        	@foreach($pages as $page)
                        		<div class="card p-5 mb-3">
									<h4 class="text-uppercase font-weight-bold pt-2 text-center">{{$page->page}}</h4>
                                    @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
    	                                <div class="form-group">
    	                                    {!! Form::label('titleSEO'.strtoupper($code).'_'.$page->id, 'SEO заголовок '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
    	                                    {!! Form::text('titleSEO'.strtoupper($code).'_'.$page->id, $page->{'titleSEO'.strtoupper($code)}, ['placeholder'=>'SEO заголовок '.strtoupper($code)] + ($errors->has('titleSEO'.strtoupper($code).'_'.$page->id) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
    	                                    <span class="text-danger">{{ $errors->first('titleSEO'.strtoupper($code).'_'.$page->id) }}</span>
    	                                </div>
    	                                <div class="form-group">
    	                                    {!! Form::label('descriptionSEO'.strtoupper($code).'_'.$page->id, 'Мета описание '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
    	                                    {!! Form::textarea('descriptionSEO'.strtoupper($code).'_'.$page->id, $page->{'descriptionSEO'.strtoupper($code)}, ['placeholder'=>'Мета описание '.strtoupper($code)] + ($errors->has('descriptionSEO'.strtoupper($code).'_'.$page->id) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
    	                                    <span class="text-danger">{{ $errors->first('descriptionSEO'.strtoupper($code).'_'.$page->id) }}</span>
    	                                </div>
    	                                <div class="form-group">
    	                                    {!! Form::label('keywordsSEO'.strtoupper($code).'_'.$page->id, 'Ключевые слова '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
    	                                    {!! Form::text('keywordsSEO'.strtoupper($code).'_'.$page->id, $page->{'keywordsSEO'.strtoupper($code)}, ['placeholder'=>'Ключевые слова '.strtoupper($code)] + ($errors->has('keywordsSEO'.strtoupper($code).'_'.$page->id) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
    	                                    <span class="text-danger">{{ $errors->first('keywordsSEO'.strtoupper($code).'_'.$page->id) }}</span>
    	                                </div>
                                    @endforeach
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
@endsection