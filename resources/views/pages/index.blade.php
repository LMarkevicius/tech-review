@extends('main')

@section('title', '| Index')

@section('content')

  <section id="special">
    <div class="row align">
      <div class="col-md-8">
        <img src="{{ asset('images/main.png') }}" alt="tech guru" class="img-responsive main-image">
      </div>

      <div class="col-md-4">
        <div class="wrapper align2">
          <h1>Tech Guru</h1>
          <p class="lead">Everything you need to know about your favorite technology.</p>

          <div class="row">
            @if (Auth::check() == false)
              <p class="text-center">Join our community</p>

              <div class="col-md-6 bottom-margin">
                <a href="{{ route('login') }}" class="btn btn-primary btn-block">Login</a>
              </div>

              <div class="col-md-6">
                <a href="{{ route('register') }}" class="btn btn-success btn-block">Register</a>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>


  {{-- @foreach($users as $user) --}}
  @if (Auth::user())
    {{ Auth::user()->hasRole('Admin') ? "Admin" : "Not Admin" }}

  @endif

  {{-- {{ Auth::user()->roles }} --}}


  {{-- @endforeach --}}

  <section id="main">
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Categories</h3>
          </div>
          <div class="panel-body">
            <ul class="menu">
              @foreach ($categories as $category)
                <li class="item">
                  @if (count($category->SubCategory) > 0)
                    <a href="#">{{ $category->name }}</a>
                    @if (count($category->SubCategory) != 0)
                      <ul>
                        @foreach ($category->SubCategory as $subcat)
                          <li class="subitem"><a href="{{ route('subcategories.show', [$category->slug, $subcat->id]) }}">{{ $subcat->name }}</a></li>
                        @endforeach
                      </ul>
                    @endif
                  @else
                    <a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
                  @endif
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-9">
        <h2 class="text-center no-margin">Recent Products</h2>

        <div class="row top-margin">
          @foreach ($products as $product)
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

  </section>

@endsection

@section('scripts')
  <script>
    $(function() {
      var menu_ul = $('.menu > li > ul'), menu_a = $('.menu > li > a');

      menu_ul.hide();

      // if ($('.menu > li').children('ul').length == 0) {
      //   console.log('Nera ulu');
      // } else {
        menu_a.click(function(e) {
          if ($(this).parent('li').children('ul').length != 0) {
            e.preventDefault();
          }

          if (!$(this).hasClass('active')) {
            menu_a.removeClass('active');
            menu_ul.filter(':visible').slideUp('normal');
            $(this).addClass('active').next().stop(true, true).slideDown('normal');
          } else {
            $(this).removeClass('active');
            $(this).next().stop(true, true).slideUp('normal');
          }
        });
      // }
    });
  </script>
@endsection
