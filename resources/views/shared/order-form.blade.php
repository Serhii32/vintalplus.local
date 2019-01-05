<link href="{{ asset('css/email-modal.css') }}" rel="stylesheet">
<div id="order-modal" class="order-modal">
  
    {!! Form::open(['route'=>'order', 'class'=>'order-modal-content order-animate']) !!}
        <div class="w-100 text-right">
            <span id="order-close" class="order-close">&times;</span>
        </div>
   
        <div class="container">
            {!! Form::hidden('hiddenProductId', '', ['id'=>'hidden-modal']) !!}
            <div class="form-group">
                {!! Form::label('userName', 'Имя:', ['class' => 'text-uppercase font-weight-bold']) !!}
                {!! Form::text('userName', old('userName'), ['placeholder'=>'Имя'] + ($errors->has('userName') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                <span class="text-danger">{{ $errors->first('userName') }}</span>
            </div>
            <div class="form-group">
                {!! Form::label('userPhone', 'Телефон:', ['class' => 'text-uppercase font-weight-bold']) !!}
                {!! Form::number('userPhone', old('userPhone'), ['placeholder'=>'Телефон'] + ($errors->has('userPhone') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                <span class="text-danger">{{ $errors->first('userPhone') }}</span>
            </div>
            <div class="form-group">
                {!! Form::label('userEmail', 'Email:', ['class' => 'text-uppercase font-weight-bold']) !!}
                {!! Form::email('userEmail', old('userEmail'), ['placeholder'=>'Email'] + ($errors->has('userEmail') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                <span class="text-danger">{{ $errors->first('userEmail') }}</span>
            </div>
            <div class="form-group">
                {!! Form::submit('Отправить', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>
@if (session('orderSuccess'))
    <div id="order-modal2" class="order-modal2">
        <div class="order-modal-content order-animate py-5 text-center">
            <h3>Спасибо! Заказ отправлен в обработку</h3>
        </div>
    </div>
@endif
<script src="{{ asset('js/email-modal.js') }}"></script>
@if(count($errors->all()))
    <script>showModal({{old('hiddenProductId')}});</script>
@endif
