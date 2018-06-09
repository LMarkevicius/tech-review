@extends('dashboard')

@section('title', '| Create New Product')

@section('styles')
  {!! Html::style('css/parsley.css') !!}
@endsection

@section('dashboard-title', 'Products')
@section('dashboard-description', 'Create New Products')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h1>Create New Product</h1>

        <hr>

        {!! Form::open(['route' => 'dashboard.products.store', 'data-parsley-validate' => '']) !!}

          <div class="form-group">
            {{ Form::label('name', 'Product Name') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'minlength' => '3', 'maxlength' => '255']) }}
          </div>

          <div class="form-group">
            {{ Form::label('slug', 'Slug') }}
            {{ Form::text('slug', null, ['class' => 'form-control', 'required' => '', 'minlength' => '3', 'maxlength' => '255']) }}
          </div>

          <div class="form-group">
            {{ Form::label('description', 'Product Description') }}
            {{ Form::textarea('description', null, ['class' => 'form-control']) }}
          </div>

          {{ Form::submit('Create Product', ['class' => 'btn btn-success btn-lg btn-block']) }}

        {!! Form::close() !!}
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  {!! Html::script('js/parsley.min.js') !!}
@endsection
