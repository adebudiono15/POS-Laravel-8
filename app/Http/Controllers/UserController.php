<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Session;

class UserController extends Controller
{
    public function getupdatepassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
          ]);

          $currentPassword = auth()->user()->password;
          $old_password = request('old_password');

          if(Hash::check($old_password, $currentPassword)){
            auth()->user()->update([
                'password' => bcrypt(request('password')),
            ]);
            return redirect()->back();
          }else{
              Session::flash('failed');
              return redirect()->back();
          }
    }
}
