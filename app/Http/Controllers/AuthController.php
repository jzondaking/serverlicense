<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    public function viewLogin() 
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('auth.login')->withInput()->withErrors($validator);
        }

        $credentials = $request->only('email', 'password');
        $auth = Auth::attempt($credentials, $request->has('remember'));

        if ($auth) {
         
            return redirect()->route('dashboard.index')->with('success', 'Đăng nhập thành công! Chào mừng quay trở lại ^^');
        
        } else {

            return redirect()->route('auth.login')->withInput()->withErrors([
                "Email hoặc mật khẩu không đúng."
            ]);

        }
    }

    public function doLogout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('auth.login');
    }

    public function viewChangePwd()
    {
        return view('auth.change-password');
    }

    public function doChangePwd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old' => 'required',
            'new' => 'required|min:8',
            'confirm' => 'required|same:new',
        ]);

        if ($validator->fails()) {
            return redirect()->route('auth.change_pwd')->withInput()->withErrors($validator);
        }

        if (Hash::check($request->old, Auth::user()->password)) {

            User::whereId(Auth::user()->id)->update([
                'password' => Hash::make($request->new)
            ]);

            return redirect()->route('auth.change_pwd')->with('success', 'Đổi mật khẩu thành công!');

        } else {
            return redirect()->route('auth.change_pwd')->withInput()->withErrors([
                'Mật khẩu cũ không hợp lệ!'
            ]);
        }
    }

}
