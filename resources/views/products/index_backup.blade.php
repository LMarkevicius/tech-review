@extends('main')

@section('title', '| All Products')

@section('content')

  <section id="special">
    <div class="row">
      <div class="col-md-10">
        <h1>All Products</h1>
      </div>

      <div class="col-md-2">
        <a href="{{ route('products.create') }}" class="btn btn-block btn-primary btn-h1-spacing">Create New Product</a>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">

        {{-- <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Sort By
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="#">By Name</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </div> --}}

        <form action="{{ route('products.index') }}" method="get">

          <select class="form-control" name="sortBy" onchange="this.form.submit()">
            <option value="">Sort By</option>
            <option value="name">By name</option>
            <option value="comments">By comments</option>
          </select>
        </form>

        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Description</th>
              <th>Comments</th>
              <th>Created At</th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            @foreach ($products as $key => $product)
              <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ substr(strip_tags($product->description), 0, 50) }} {{ strlen(strip_tags($product->description)) > 50 ? "..." : "" }}</td>
                <td>{{ $product->comments->count() }}</td>
                <td>{{ date('M j, Y H:i', strtotime($product->created_at)) }}</td>
                <td>
                  <a href="{{ route('products.show', $product->slug) }}" class="btn btn-default btn-xs">View</a>
                  <a href="{{ route('products.edit', $product->slug) }}" class="btn btn-default btn-xs">Edit</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div class="text-center">
          {!! $products->appends(['sortBy' => request()->sortBy])->links() !!}
        </div>

        <h4 class="text-left">{{ $products->currentPage() }} Page of {{ $products->lastPage() }}</h4>

        <h4 class="text-center">{{ $products->firstItem() }} to {{ $products->firstItem() + $products->count() - 1 }} Products</h4>

      </div>
    </div>
  </section>

@endsection
