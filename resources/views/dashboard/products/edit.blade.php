@extends('dashboard')

@section('title', '| Edit Product')

@section('dashboard-title', 'Products')
@section('dashboard-description', 'Edit Your Products')

@section('content')

  <div class="row">

    {!! Form::model($product, ['route' => ['dashboard.products.update', $product->id], 'method' => 'PUT']) !!}

    <div class="col-md-8">
      <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, ['class' => 'form-control input-lg']) }}
      </div>

      <div class="form-group">
        {{ Form::label('slug', 'Slug') }}
        {{ Form::text('slug', null, ['class' => 'form-control', 'required' => '', 'minlength' => '3', 'maxlength' => '255']) }}
      </div>

      <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', null, ['class' => 'form-control']) }}
      </div>
    </div>

    <div class="col-md-4">
      <div class="well">
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
            {!! Html::linkRoute('dashboard.products.show', 'Cancel', [$product->id], ['class' => 'btn btn-danger btn-block']) !!}
          </div>

          <div class="col-sm-6">
            {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
          </div>
        </div>
      </div>
    </div>

    {!! Form::close() !!}

  </div>

@endsection
