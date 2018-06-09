@extends('main')

@section('title', '| Edit Product')

@section('styles')
  {!! Html::style('css/select2.min.css') !!}

  <script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'link code',
      menubar: false
    });
  </script>
@endsection

@section('content')

  <section id="special">
    <div class="row">

      {!! Form::model($product, ['route' => ['products.update', $product->slug], 'method' => 'PUT', 'files' => true]) !!}

      <div class="col-md-8">
        <div class="form-group">
          {{ Form::label('name', 'Name') }}
          {{ Form::text('name', null, ['class' => 'form-control input-lg']) }}
        </div>

        <div class="form-group">
          {{ Form::label('slug', 'Slug') }}
          {{ Form::text('slug', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
          {{ Form::label('category_id', 'Category') }}

          <div class="panel panel-default">
            <div class="panel-body">
              <ul class="menu">
                @foreach ($categories as $category)
                  <li class="item" id="{{ $category->id }}">
                    <a href="#">{{ $category->name }}</a>
                    @if (count($category->SubCategory) != 0)
                      <ul>
                        @foreach ($category->SubCategory as $subcat)
                          <li class="subitem" data-sub-id="{{ $subcat->id }}" id="{{ $subcat->id }}"><a href="#">{{ $subcat->name }} and {{ $subcat->id }}</a></li>
                        @endforeach
                      </ul>
                    @endif
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>

        {{ Form::hidden('category_id', null, ['id' => 'category_id']) }}
        {{ Form::hidden('subcategory_id', null, ['id' => 'subcategory_id']) }}

        <div class="form-group">
          {{ Form::label('tags', 'Tags') }}
          {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}
        </div>

        <div class="form-group">
          {{ Form::label('featured_image', 'Update Featured Image') }}
          {{ Form::file('featured_image') }}
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
              {!! Html::linkRoute('products.show', 'Cancel', [$product->slug], ['class' => 'btn btn-danger btn-block']) !!}
            </div>

            <div class="col-sm-6">
              {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
            </div>
          </div>
        </div>
      </div>

      {!! Form::close() !!}

    </div>
  </section>

@endsection

@section('scripts')
  {!! Html::script('js/select2.min.js') !!}

  <script>
  $('.select2-multi').select2();

  $('.select2-multi').select2().val({!! json_encode($product->tags->pluck('id')) !!}).trigger('change');

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

    var item = $('.menu > li');
    // var item_id;
    var subitem = $('.menu > li > ul > .subitem');

    item.click(function(e) {
      e.preventDefault();

      if ($(this).children('a').hasClass('aktyv') == false) {
        $('.menu li a').removeClass('aktyv');
        $(this).children('a').toggleClass('aktyv');
      }
      if ($(this).children('ul').length == 0) {
        var item_id = $(this).attr('id');



        $(this).toggleClass('aktyv');
        $('#category_id').val(item_id);
        $('#subcategory_id').val('0');

        console.log('Item ID: ' + item_id);
      }
    });

    subitem.click(function(e) {
      e.preventDefault();
      if ($(this).children('a').hasClass('aktyv') == false) {
        $('.menu li ul li a').removeClass('aktyv');
        $('.menu li a').removeClass('aktyv');

        $(this).parent().parent().children('a').addClass('aktyv');
        $(this).children('a').toggleClass('aktyv');
      }
      // $(this).children('a').toggleClass('aktyv');
      var sub_id = $(this).attr('id');
      var parent_id = $(this).closest('.item').attr('id');

      $('#category_id').val(parent_id);
      $('#subcategory_id').val(sub_id);

      console.log('Sub Item ID: ' + sub_id);
      console.log('Parent ID: ' + parent_id);
    });
  </script>
@endsection
