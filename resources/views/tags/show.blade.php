@extends('main')

@section('title', '| Tag View')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h1 class="text-center">{{ $tag->name }} <small>{{ $tag->products()->count() }} Products</small></h1>
      </div>

      <div class="col-md-4">
        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-success pull-right">Edit</a>
        {!! Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'DELETE']) !!}
          {{ Form::submit('Delete Tag', ['class' => 'btn btn-danger btn-block']) }}
        {!! Form::close() !!}
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="row">
          @foreach ($tag->products as $product)
            <div class="col-md-4">
              <a href="{{ route('products.show', $product->slug) }}" class="thumbnail">
                <img src="http://placehold.it/350x150">
              </a>
              <h3>{{ $product->name }}</h3>
              <p>{{ $product->description }}</p>

              <div class="row">
                <div class="col-sm-6">
                  @foreach ($product->tags as $tag)
                    <a href="{{ route('tags.show', $tag->id) }}"><span class="label label-default">{{ $tag->name }}</span></a>
                  @endforeach
                </div>

                <div class="col-sm-6">
                  <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary btn-block">View</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      </div>
    </div>


@endsection
