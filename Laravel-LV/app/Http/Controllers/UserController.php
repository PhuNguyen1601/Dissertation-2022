<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Giangvien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;


session_start();

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function checklogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'email.email' => 'Email không đúng định dạng',
        ]);
        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator->errors())->withInput();
        }
        $email = $request->email;
        $password = md5($request->password);
        if ($email === 'admin@gmail.com') {
            $result = User::where('email', $email)->where('password', $password)->first();
            if ($result) {
                Session::put('name', $result->tencb);
                Session::put('cv', '0');
                return Redirect::to('/admin');
            } else {
                Session::put('message', 'Tài khoản hoặc mật khẩu không đúng. Vui lòng nhập lại!');
                return view('login');
            }
        } else {
            $result = Giangvien::where('email', $email)->where('password', $password)->first();
            if ($result) {
                Session::put('name', $result->tengv);
                Session::put('id', $result->id);
                Session::put('cv', '1');
                return Redirect::to('/admin');
            } else {
                Session::put('message', 'Tài khoản hoặc mật khẩu không đúng. Vui lòng nhập lại!');
                return view('login');
            }
        }
    }
    public function logout()
    {
        Session::flush();
        return Redirect::to('/');
    }
}