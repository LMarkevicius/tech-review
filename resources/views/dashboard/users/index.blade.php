@extends('dashboard')

@section('title', '| Users')

@section('dashboard-title', 'Users')
@section('dashboard-description', 'Manage Your Users')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h1 class="text-center">All Users</h1>

        <h2 class="text-center">Admins</h2>

        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Created</th>
              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($admins->users as $key => $user)
              {{-- @if ($user->hasRole('Admin')) --}}
                <form action="{{ route('dashboard.assign') }}" method="POST">
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }} <input type="hidden" name="email" value="{{ $user->email }}"></td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                      <input type="hidden" name="role_user" value="user" />
                      <button type="submit" class="btn btn-primary btn-xs">Make User</button>
                      <a href="#" class="btn btn-danger btn-xs">Delete</a>
                    </td>
                  </tr>
                  {{ csrf_field() }}
                </form>
              {{-- @endif --}}
            @endforeach
          </tbody>
        </table>

        <h2 class="text-center">Users</h2>

        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Created</th>
              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($users->users as $key => $user)
              @if ($user->hasRole('User'))
                <form action="{{ route('dashboard.assign') }}" method="POST">
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }} <input type="hidden" name="email" value="{{ $user->email }}"></td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                      <input type="hidden" name="role_admin" value="admin" />
                      <button type="submit" class="btn btn-primary btn-xs">Make Admin</button>
                      <a href="#" class="btn btn-danger btn-xs">Delete</a>
                    </td>
                  </tr>
                  {{ csrf_field() }}
                </form>
              @endif
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>

@endsection
