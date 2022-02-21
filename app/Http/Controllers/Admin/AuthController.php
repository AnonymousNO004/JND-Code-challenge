<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){
        if(Auth::guard('full')->check() || Auth::guard('admin')->check()){
            return redirect('user');
        }
        $data['page_title'] = 'เข้าสู่ระบบ';
        return view('admin/auth/login', $data);
    }

    public function check_login(Request $request){
        $input_all = $request->all();
        $validator = Validator::make($input_all, [
            'username' => 'required',
            'password' => 'required',
        ],[
            'username' => 'username is required',
            'password' => 'password is required',
        ]);
        $response['statusCode'] = 400;
        $response['status'] = $validator->errors()->first();
        if(!$validator->fails()){
            $existUser = User::ExistUser($input_all['username'])->first();
            $response['statusCode'] = 400;
            $response['status'] = 'Username หรือ Password ไม่ถูกต้อง';
            if(Hash::check($input_all['password'], $existUser->password) && $existUser->permission == 'full' || Hash::check($input_all['password'], $existUser->password) && $existUser->permission == 'admin'){
                if(!isset($input_all['remember'])){
                    $input_all['remember'] = false;
                }
                Auth::guard($existUser->permission)->loginUsingId($existUser->id, $input_all['remember']);
                $response['statusCode'] = 200;
                $response['status'] = 'Success';
            }
        }
        return response()->json($response, $response['statusCode']);
    }

    public function logout(){
        if(Auth::guard('full')->check()){
            Auth::guard('full')->logout();
        }else if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        }
        return redirect('admin/login');
    }
}
