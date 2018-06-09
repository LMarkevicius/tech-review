<!DOCTYPE html>
<html lang="en">
  <head>

    @include('partials._dashboard_head')

  </head>

  <body>

    @include('partials._dashboard_nav')

    @include('partials._dashboard_header')

    @include('partials._dashboard_breadcrumb')

    {{-- <div class="container-fluid"> --}}

      @include('partials._messages')

      @yield('content')

    {{-- </div> --}}

    @include('partials._dashboard_footer')

  </body>
</html>
