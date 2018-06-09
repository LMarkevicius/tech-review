@extends('dashboard')

@section('title', '| Dashboard')

@section('dashboard-title', 'Dashboard')
@section('dashboard-description', 'Manage Your Site')

@section('content')

  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="list-group">
            <a href="{{ route('dashboard.index') }}" class="list-group-item active main-color-bg">
              <span class="glyphicon glyphicon-cog"></span>
              Dashboard
            </a>
            <a href="{{ route('dashboard.products.index') }}" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Products <span class="badge">{{ $products }}</span></a>
            <a href="{{ route('dashboard.users.index') }}" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge">{{ count($users) }}</span></a>
            <a href="{{ route('dashboard.categories.index') }}" class="list-group-item"><span class="glyphicon glyphicon-film" aria-hidden="true"></span> Categories <span class="badge">{{ $categories + $subcategories }}</span></a>
            <a href="pages.html" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Pages - fake <span class="badge">fake</span></a>
          </div>
        </div>

        <div class="col-md-9">

            <table class="table">
              <thead>
                <tr>
                  <td>Name</td>
                  <td>Email</td>
                  <td>User</td>
                  <td>Admin</td>
                </tr>
              </thead>

              <tbody>
                @foreach ($users as $user)
                  <form action="{{ route('dashboard.assign') }}" method="POST">
                    <tr>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }} <input type="hidden" name="email" value="{{ $user->email }}"></td>
                      <td><input type="checkbox" {{ $user->hasRole('User') ? "checked" : "" }} name="role_user" value="user"></td>
                      <td><input type="checkbox" {{ $user->hasRole('Admin') ? "checked" : "" }} name="role_admin" value="admin"></td>
                      <td><button type="submit" name="button">Assign</button></td>
                    </tr>
                    {{ csrf_field() }}
                  </form>
                @endforeach
              </tbody>
            </table>






        </div>

      </div>
    </div>
  </section>

@endsection
