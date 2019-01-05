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
                <div class="container py-4">
                    <h2 class="text-center font-weight-bold text-uppercase">Список партнеров</h2>
                    @if(count($partners))
                        <div class="row justify-content-center">
                            @foreach($partners as $partner)
                                <div class="col-12 col-sm-6 col-md-4 my-3">
                                    <div class="card h-100 shadow p-2">
                                        <a class="card-link text-secondary p-1" href="{{route('admin.partners.edit', $partner->id)}}">
                                            <div class="text-center"><img class="img-fluid img-thumbnail" src="{{$partner->main_photo ? asset($partner->main_photo) : asset('img/common/default.png')}}" alt="{{$partner->titleRU}}"></div>
                                            <h4 class="text-center text-uppercase">{{$partner->titleRU}}</h4>
                                        </a>
                                        {!! Form::open(['route'=> ['admin.articles.destroy', $partner->id], 'class'=>'btn btn-danger mb-0 mt-auto mx-auto w-100 p-0', 'method' => 'delete', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}
                                            {!! Form::submit('Удалить', ['class'=>'btn btn-danger mb-0 mt-auto mx-auto w-100 text-uppercase font-weight-bold']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="custom-links py-4">{{$partners->links()}}</div>
                    @else
                        <h3 class="text-center font-weight-bold text-uppercase m-4">Партнеры отсутствуют</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
