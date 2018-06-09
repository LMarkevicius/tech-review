@extends('main')

@section('title', '| Categories')

@section('content')

  <h1 class="text-center">All Categories</h1>


  <div class="row">
    <div class="col-md-8 col-md-offset-2">
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
                        <li class="subitem"><a href="{{ route('subcategories.show', [$subcat->category_id, $subcat->id]) }}">{{ $subcat->name }}</a></li>
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
  </div>

@endsection

@section('scripts')
  <script>
    $(function() {
      var menu_ul = $('.menu > li > ul'), menu_a = $('.menu > li > a');

      menu_ul.hide();

      menu_a.click(function(e) {
        e.preventDefault();
        if (!$(this).hasClass('active')) {
          menu_a.removeClass('active');
          menu_ul.filter(':visible').slideUp('normal');
          $(this).addClass('active').next().stop(true, true).slideDown('normal');
        } else {
          $(this).removeClass('active');
          $(this).next().stop(true, true).slideUp('normal');
        }
      });
    });
  </script>
@endsection
