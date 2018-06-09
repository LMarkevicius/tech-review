@extends('main')

@section('title', '| Edit Comment')

@section('content')

  <div class="row">

    {!! Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PUT']) !!}

    <div class="col-md-8">
      <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>

      <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::text('email', null, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>

      <div class="form-group">
        {{ Form::label('comment', 'Comment') }}
        {{ Form::textarea('comment', null, ['class' => 'form-control']) }}
      </div>

      {{ Form::submit('Update Comment', ['class' => 'btn btn-success btn-block']) }}
    </div>

    {!! Form::close() !!}

  </div>

@endsection
