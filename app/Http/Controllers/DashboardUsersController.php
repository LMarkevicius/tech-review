<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class DashboardUsersController extends Controller
{
  public function index() {
    $users = Role::where('name', 'User')->first();
    // $admins = [];
    // foreach ($users as $key => $user) {
    //   $admins[$key] = $user->roles()->where('name', 'Admin')->get();
    // }

    $admins = Role::where('name', 'Admin')->first();

    // $users->roles

    return view('dashboard.users.index')->withUsers($users)->withAdmins($admins);
  }

  public function UserAssign(Request $request) {
    $user = User::where('email', $request->email)->first();
    $user->roles()->detach();

    if ($request->role_user == "user") {
      $user->roles()->attach(Role::where('name', 'User')->first());
    }

    if ($request->role_admin == "admin") {
      $user->roles()->attach(Role::where('name', 'Admin')->first());
    }

    return redirect()->back();
  }
}
