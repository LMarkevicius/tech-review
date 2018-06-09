@extends('main')

@section('title', '| Login')

@section('content')

  <section id="special">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        {!! Form::open() !!}

          <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', null, ['class' => "form-control $errors->has('email') ? ' has-error' : ''"]) }}

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>

          <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', ['class' => "form-control $errors->has('password') ? ' has-error' : ''"]) }}

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>

          {{ Form::checkbox('remember') }}{{ Form::label('remember', 'Remember Me') }}

          {{ Form::submit('Login', ['class' => 'btn btn-primary btn-block']) }}

          <p><a href="{{ url('password/reset') }}">Forgot Password?</a></p>

        {!! Form::close() !!}
      </div>
    </div>
  </section>

@endsection
