@extends('dashboard')

@section('title', '| All Categories')

@section('dashboard-title', 'Categories')
@section('dashboard-description', 'Manage Your Categories')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h1 class="text-center">All Categories</h1>

        <h3 class="text-center">Main Categories</h3>

        {{-- <div class="table-responsive"> --}}
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($categories as $key => $category)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $category->name }}</td>
                  <td>

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <h3 class="text-center">Sub Categories</h3>

          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Belongs To (Category)</th>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody> {!! $key = 0 !!}
              @foreach ($categories as $category)

                @foreach ($category->SubCategory as $sub_cat)
                  <tr>
                    {!! $key++ !!}
                    <td>{{ $key }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $sub_cat->name }}</td>
                    <td>

                    </td>
                  </tr>
                @endforeach
              @endforeach
            </tbody>
          </table>
          {{-- <ul>
            @foreach ($categories as $category)

              <li>{{ $category->name }}</li>

              <ul>
                @foreach ($category->SubCategory as $sub_cat)
                  <li>{{ $sub_cat->name }}</li>
                @endforeach
              </ul>

            @endforeach
          </ul> --}}

        </div>

        <div class="col-md-4">
          <div class="well">
            {!! Form::open(['route' => 'dashboard.categories.store', 'method' => 'POST']) !!}

              <h2>New Category</h2>

              <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
              </div>

              {{ Form::submit('Create New Category', ['class' => 'btn btn-primary btn-block']) }}

            {!! Form::close() !!}
          </div>

          <div class="well">
            {!! Form::open(['route' => 'dashboard.subcategories.store', 'method' => 'POST']) !!}

              <h2>New Sub Category</h2>

              <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
              </div>

              <div class="form-group">
                <h4>Choose Main Category</h4>

                @foreach ($categories as $category)
                  {{ Form::checkbox('category_id', $category->id) }}
                  {{ Form::label('category_id', $category->name) }}
                @endforeach
              </div>

              {{ Form::submit('Create New Sub Category', ['class' => 'btn btn-primary btn-block']) }}

            {!! Form::close() !!}
          </div>
        </div>

      </div>
    </div>
  </div>

@endsection
