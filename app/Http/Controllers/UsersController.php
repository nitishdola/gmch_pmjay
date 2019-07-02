<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon, Hash;
use App\User;

class UsersController extends Controller
{

    public function create() {
        if(Auth::user()->role == 'admin'):
            return view('users.create');
        endif;

    }

    public function save(Request $request) {
        if(Auth::user()->role == 'admin'):
            $username   = trim($request->username);
            $full_name  = trim($request->full_name);
            $password   = Hash::make($request->password);

            User::create([
                'username' => $username,
                'password' => $password,
                'name'     => $full_name,
                'role'     => $request->role,
            ]);

            return Redirect::route('user.index')->with(['message' => 'User added successfully !', 'alert-class' => 'alert-success']);
        endif;
    }

    public function index(Request $request) {
        $results = User::where('status',1)->get();
        return view('users.index', compact('results'));
    }


    public function edit($id) {
        if(Auth::user()->role == 'admin'):
            $user = User::findOrFail(Crypt::decrypt($id));
            return view('users.edit', compact('user'));
        endif;

    }

    public function changePassword() {
    	return view('users.change_password');
    }

    public function savePassword(Request $request) {
    	//dd($request->all());
    	$previous_password = $request->previous_password;

    	$user = User::find(Auth::user()->id);

        if (Auth::attempt(['username' => $user->username, 'password' => $previous_password]))
        {
            $count = 1;
        }else{
            $count = 0;
        }

    	if($count):
	    	$new_password = trim($request->password);
	    	$confirm_password = trim($request->password_confirm);

	    	if($new_password == $confirm_password) {
	    		//change password
	    		$user = User::find(Auth::user()->id);
	    		$user->password = Hash::make($confirm_password);

	    		$user->save();

	    		return Redirect::route('home')->with(['message' => 'Password changed !', 'alert-class' => 'alert-success']);
	    	}else{
	    		return Redirect::back()->with(['message' => 'Password not matched !', 'alert-class' => 'alert-danger']);
	    	}
	    else:
	    	return Redirect::back()->with(['message' => 'Wrong password !', 'alert-class' => 'alert-danger']);
	    endif;
    }
}
