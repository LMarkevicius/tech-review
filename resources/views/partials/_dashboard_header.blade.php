<header id="header">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1><span class="glyphicon glyphicon-cog"></span>@yield('dashboard-title') <small>@yield('dashboard-description')</small></h1>
      </div>

      <div class="col-md-2">
        <div class="dropdown create">
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Create Content
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="{{ route('dashboard.products.create') }}">Add Product</a></li>
            <li><a href="#">Add User - fake</a></li>
            <li><a type="button" data-toggle="modal" data-target="#addPage">Add Page - fake</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>
