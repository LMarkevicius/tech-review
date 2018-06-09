@extends('dashboard')

@section('title', '| All Products')

@section('dashboard-title', 'Products')
@section('dashboard-description', 'Manage Your Products')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>All Products</h1>

        {{-- <div class="table-responsive"> --}}
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Comments</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($products as $key => $product)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $product->name }}</td>
                  <td>{{ substr(strip_tags($product->description), 0, 50) }} {{ strlen(strip_tags($product->description)) > 50 ? '...' : '' }}</td>
                  <td>{{ $product->comments()->count() }}</td>
                  <td>
                    <a href="{{ route('dashboard.products.show', $product->id) }}" class="btn btn-default btn-xs">View</a>
                    <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-primary btn-xs">Edit</a>
                    {!! Form::open(['route' => ['dashboard.products.destroy', $product->id], 'method' => 'DELETE']) !!}
                      {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) }}
                    {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
