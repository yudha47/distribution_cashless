<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller{
  public function index(){
    $result = User::Join('user_group', 'user_group.id_group', '=', 'users.level')
                    ->get();

    $level = UserGroup::all();

    return view('user/user_management', [
                                          'title' => 'user management',
                                          'data' => $result,
                                          'level' => $level
                                        ]);
  }

  public function add_user(Request $request){
    User::create([
      'full_name' => $request->fullname,
      'username' => str_replace(' ', '_', $request->username),
      'password' => bcrypt($request->password),
      'email' => $request->email,
      'level' => $request->level
    ]);
    
    Session::put('messages', "success add new user : $request->fullname"); 
    return redirect()->route('users');
  }

  public function reset_password(Request $request){
    $id = $request->id_user;
    User::where("id", $id)
              ->update([
                        'password' => bcrypt('P@ssw0rd')
                      ]);
    
    Session::put('messages', 'success : password reset with --P@ssw0rd--'); 
    return redirect()->route('users');
  }

  public function get_users(Request $request){
    $id = $request->id_users;
    
    $data = User::select('*')
                  ->where("id", $id)
                  ->first();

    return json_encode(array('data'=>$data));
  }

  public function update_users(Request $request){
    if($request->password == null){
      User::where("id", $request->id)
              ->update([
                        'full_name' => $request->fullname,
                        'username' => str_replace(' ', '_', $request->username),
                        'email' => $request->email,
                        'level' => $request->level
                      ]);
    }else{
      User::where("id", $request->id)
              ->update([
                        'full_name' => $request->fullname,
                        'username' => str_replace(' ', '_', $request->username),
                        'password' => bcrypt($request->password),
                        'email' => $request->email,
                        'level' => $request->level
                      ]);
    }
    
    Session::put('messages', 'success'); 
    return redirect()->route('users');
  }

  public function delete_users($id){
    User::where("id", $id)->delete();
    
    Session::put('messages', 'success'); 
    return redirect()->route('users');
  }

  public function change_password(Request $request){
    User::where("id", $request->id_user)
        ->update([
                  'password' => bcrypt($request->password1),
                ]);
    
    Session::put('messages', 'success'); 
    return redirect()->route('dashboard');
  }
}
