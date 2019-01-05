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
                    <h2 class="text-center font-weight-bold text-uppercase">Список услуг</h2>
                    @if(count($services))
                        <div class="row justify-content-center">
                            @foreach($services as $service)
                                <div class="col-12 col-sm-6 col-md-4 my-3">
                                    <div class="card h-100 shadow p-2">
                                        <a class="card-link text-secondary p-1" href="{{route('admin.services.edit', $service->id)}}">
                                            <div class="text-center"><img class="img-fluid img-thumbnail" src="{{$service->main_photo ? asset($service->main_photo) : asset('img/common/default.png')}}" alt="{{$service->titleRU}}"></div>
                                            <h4 class="text-center text-uppercase">{{$service->titleRU}}</h4>
                                        </a>
                                        {!! Form::open(['route'=> ['admin.services.destroy', $service->id], 'class'=>'btn btn-danger mb-0 mt-auto mx-auto w-100 p-0', 'method' => 'delete', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}
                                            {!! Form::submit('Удалить', ['class'=>'btn btn-danger mb-0 mt-auto mx-auto w-100 text-uppercase font-weight-bold']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="custom-links py-4">{{$services->links()}}</div>
                    @else
                        <h3 class="text-center font-weight-bold text-uppercase m-4">Услуги отсутствуют</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
