<nav class="navbar navbar-default navbar-special navbar-fixed-top">
  <div class="container-fluid">

    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Tech Guru</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="{{ Request::is('/') ? "active" : "" }}"><a href="{{ route('home.index') }}">Home <span class="sr-only">(current)</span></a></li>
          <li class="{{ Request::is('about') ? "active" : "" }}"><a href="{{ route('about.index') }}">About</a></li>
          <li class="{{ Request::is('contact') ? "active" : "" }}"><a href="{{ route('contact.index') }}">Contact</a></li>
          @if (Auth::user())
            @if (Auth::user()->hasRole('Admin'))
              <li class="admin"><a href="{{ route('dashboard.index') }}" class="">Dashboard</a></li>
            @endif
          @endif
        </ul>

        @if (Auth::check())
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello {{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('products.create') }}">Create Product</a></li>
                <li><a href="{{ route('products.index') }}">Your Products</a></li>
                <li><a href="{{ route('tags.index') }}">Tags</a></li>
                <li><a href="{{ route('categories.index') }}">Categories</a></li>
                <li><a href="#">Your Profile - fake</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
              </ul>
            </li>
          </ul>
        @endif

        <form class="navbar-form navbar-right">
          <input type="text" class="form-control" placeholder="Search">
            <button type="submit" class="btn btn-default btn-search"><span class="glyphicon glyphicon-search"></span></button>
          </input>
        </form>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </div><!-- /.container-fluid -->
</nav>
