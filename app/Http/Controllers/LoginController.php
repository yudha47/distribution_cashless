<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function login(){
    return view('login');
  }

  public function authenticate(Request $request){
    $credential = $request->validate([
      'username' => 'required',
      'password' => 'required'
    ]);

    if(Auth::attempt($credential)){
      $request->session()->regenerate();
      
      $user = User::select('*')
                    ->where('username', $request->username)
                    ->get();

      $fullname='';
      $level='';
      $id='';
      foreach($user as $u){
        $fullname = $u['full_name'];
        $level = $u['level'];
        $id = $u['id'];
      }
                    
      $request->session()->put('username', $fullname);
      $request->session()->put('level', $level);
      $request->session()->put('id', $id);
      
      return redirect()->intended('/dashboard');
    }

    return back()->with('loginError', 'Login Failed');
  }

  public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    return redirect('/');
  }
}
