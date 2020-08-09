<?php

namespace App\Http\Controllers;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth')->except('login');
  }

  public function login(Request $request)
  {
    if ($request->isMethod('post')) {
      $email = $request->email;
      $password = $request->password;

      $credentials = [
        'email' => $email, 'password' => $password, 'admin' => true
      ];

      if (Auth::attempt($credentials)) {
        Toastr::success('You have logged in successfully!', 'Login Successful');
        return redirect(route('admin.dashboard'));
      } else {
        Toastr::error('Invalid Username or Password!', 'Login Failed');
        return redirect()->back();
      }

    }
    return view('admin.login');
  }

  public function logout()
  {
    Session::flush();
    return redirect(route('admin.login'));
  }

  public function dashboard()
  {
    return view('admin.dashboard');
  }

  public function settings()
  {
    return view('admin.settings');
  }

  public function checkPassword(Request $request)
  {
    $current_password = $request->current_password;
    $admin = User::where(['admin' => true])->first();

    if (Hash::check($current_password, $admin->password)) {
      return response()->json('true');
    } else {
      return response()->json('false');
    }
  }

  public function updatePassword(Request $request)
  {
    if ($request->isMethod('PUT')) {
      $admin = User::where('email', Auth::user()->email)->first();

      if (!Hash::check($request->current_password, $admin->password)) {
        Toastr::error("Password doesn't match!", 'Password mismatch');
        return redirect()->back();
      } elseif (Hash::check($request->password, $admin->password)) {
        Toastr::warning("You entered an old password!", 'Old Password');
        return redirect()->back();
      }

      $admin->password = Hash::make($request->password);
      $admin->save();

      Toastr::success('Password Updated Successfully', "Password Updated");
      return redirect(route('admin.settings'));
    }
  }
}
