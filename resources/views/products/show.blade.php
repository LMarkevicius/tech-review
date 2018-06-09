@extends('main')

<?php $titleTag = htmlspecialchars($product->name); ?>

@section('title', "| $titleTag")

@section('content')

  <section id="special">
    <div class="row">
      <div class="col-md-8">
        <h1>{{ $product->name }}</h1>

        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="img-responsive">

        <p class="lead">{!! $product->description !!}</p>
        <hr>
        {{-- <p>Posted In: {{ $product->category->name }} / {{ $product->SubCategory->name }}</p> --}}
        <div class="tags">
          @foreach ($product->tags as $tag)
            <span class="label label-default">{{ $tag->name }}</span>
          @endforeach
        </div>
      </div>

      <div class="col-md-4">
        @if (Auth::user())
          @if (Auth::user()->id == $product->user_id)
            <div class="well">
              <dt class="dl-horizontal">
                <dt>URL Slug:</dt>
                <dd><a href="{{ url($product->slug) }}">{{ url($product->slug) }}</a></dd>
              </dt>

              <dt class="dl-horizontal">
                <dt>Category:</dt>
                <dd>{{ $product->category->name }}</dd>
              </dt>

              <dt class="dl-horizontal">
                <dt>Created At:</dt>
                <dd>{{ date('M j, Y H:i', strtotime($product->created_at)) }}</dd>
              </dt>

              <dt class="dl-horizontal">
                <dt>Last Updated:</dt>
                <dd>{{ date('M j, Y H:i', strtotime($product->updated_at)) }}</dd>
              </dt>

              <hr>

              <div class="row">
                <div class="col-sm-6">
                  {!! Html::linkRoute('products.edit', 'Edit', [$product->slug], ['class' => 'btn btn-primary btn-block']) !!}
                </div>

                <div class="col-sm-6">
                  {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'DELETE']) !!}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) }}
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
          @endif
        @endif
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <h3 class="comments-title"><span class="glyphicon glyphicon-comment"></span>{{ $product->comments()->count() }} Comments</h3>
        @foreach ($product->comments as $comment)
          <div class="comment">
            <div class="author-info">
              <img src={{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) }}"" class="author-image" alt="">

              <div class="author-name">
                <h4>{{ $comment->name }}</h4>
                <p class="author-time">{{ date('F nS, Y - G:i', strtotime($comment->created_at)) }}</p>
              </div>
            </div>

            <div class="comment-content">
              {{ $comment->comment }}
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <div class="row">
      <div id="comment-form" class="col-md-8">
        {!! Form::open(['route' => ['comments.store', $product->id], 'method' => 'POST']) !!}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                {{ Form::label('email', 'Email') }}
                {{ Form::text('email', null, ['class' => 'form-control']) }}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                {{ Form::label('comment', 'Comment') }}
                {{ Form::textarea('comment', null, ['class' => 'form-control']) }}
              </div>

              {{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block']) }}
            </div>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </section>

@endsection
