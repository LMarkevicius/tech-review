<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckRole {
  public function handle($request, Closure $next) {
    if ($request->user() === null) {
      Session::flash('alert', 'Not Admin');

      return redirect()->back();
    }

    $actions = $request->route()->getAction();
    $roles = isset($actions['roles']) ? $actions['roles'] : null;

    if ($request->user()->hasAnyRole($roles) || !$roles) {
      return $next($request);
    }

    Session::flash('alert', 'Not Admin');

    return redirect()->back();
  }
}
