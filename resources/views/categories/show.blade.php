@extends('main')

@section('title', '| Category View')

@section('content')

  <section id="special">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h1 class="text-center">{{ $category->name }} <small>{{ $category->products->count() }} Products</small></h1>
        </div>
      </div>
    </div>
  </section>

  {{-- <section> --}}
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="row">
            @foreach ($category->products as $product)
              <div class="col-md-4 col-sm-6">
                <div class="product">
                  <a href="{{ route('products.show', $product->slug) }}" class="thumbnail no-margin">
                    <img src="{{ isset($product->image) ? asset('images/' . $product->image) : "http://placehold.it/265x200" }}" class="product-image">
                  </a>

                  <div class="product-body">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ substr(strip_tags($product->description), 0, 50) }} {{ strlen(strip_tags($product->description)) > 50 ? "..." : "" }}</p>

                    <div class="row">
                      <div class="col-sm-12">
                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm btn-primary btn-block">Read More</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        </div>
      </div>
    </div>
  {{-- </section> --}}

@endsection
