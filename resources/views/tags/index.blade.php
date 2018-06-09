@extends('main')

@section('title', '| All Tags')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h1 class="text-center">All Tags</h1>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($tags as $tag)
              <tr>
                <td>{{ $tag->id }}</td>
                <td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
                <td>

                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div class="col-md-4">
          <div class="well">
            {!! Form::open(['route' => 'tags.store', 'method' => 'POST']) !!}

              <h2>New Tag</h2>

              <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
              </div>

              {{ Form::submit('Create New Tag', ['class' => 'btn btn-primary btn-block']) }}

            {!! Form::close() !!}
          </div>

        </div>

      </div>
    </div>
  </div>

@endsection
