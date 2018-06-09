<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      @if (Request::is('dashboard'))
        <li class="active">Dashboard</li>
      @endif

      @if (Request::is('dashboard/products'))
        <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="active">Products</li>
      @endif

      @if (Request::is('dashboard/products/*'))
        <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li><a href="{{ route('dashboard.products.index') }}">Products</a></li>
        <li class="active">{{ $product->name }}</li>
      @endif

      @if (Request::is('dashboard/users'))
        <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="active">Users</li>
      @endif
    </ol>
  </div>
</section>
