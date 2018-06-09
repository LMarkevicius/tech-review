@extends('main')

@section('title', '| Contact')

@section('content')

  <section id="special">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <h1 class="text-center">Contact Me</h1>

        <hr>

        {!! Form::open(['url' => 'contact', 'method' => 'POST']) !!}
          <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', null, ['class' => 'form-control']) }}
          </div>

          <div class="form-group">
            {{ Form::label('subject', 'Subject') }}
            {{ Form::text('subject', null, ['class' => 'form-control']) }}
          </div>

          <div class="form-group">
            {{ Form::label('message', 'Message') }}
            {{ Form::textarea('message', null, ['class' => 'form-control']) }}
          </div>

          {{ Form::submit('Send Message', ['class' => 'btn btn-success btn-block']) }}
        {!! Form::close() !!}
      </div>
    </div>
  </section>

@endsection
