<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
  public function login(Request $request)
  {
    if ($request->isMethod('post')) {
      $email = $request->email;
      $password = $request->password;

      $credentials = [
        'email' => $email, 'password' => $password, 'admin' => true
      ];

      if (Auth::attempt($credentials)) {
        return redirect(route('admin.dashboard'));
      } else {
        return 'Fail';
      }

    }
    return view('admin.login');
  }

  public function dashboard()
  {
    return view('admin.dashboard');
  }
}
