@extends('main')

@section('title', '| Tag Edit')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        {!! Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'PUT']) !!}

          <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
          </div>

          {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}

        {!! Form::close() !!}
      </div>
    </div>
  </div>


@endsection
