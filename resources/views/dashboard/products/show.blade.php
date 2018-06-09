@extends('dashboard')

@section('title', '| Product Preview')

@section('dashboard-title', 'Products')
@section('dashboard-description', 'View Your Product')

@section('content')

  <div class="dark-content">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h1>{{ $product->name }}</h1>
          <p class="lead">{{ $product->description }}</p>

          <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="backend-comments">
            <h3>Comments <small>{{ $product->comments()->count() }} total</small></h3>

            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Comment</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach ($product->comments as $comment)
                  <tr>
                    <td>{{ $comment->name }}</td>
                    <td>{{ $comment->email }}</td>
                    <td>{{ $comment->comment }}</td>
                    <td>
                      <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                      <a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
