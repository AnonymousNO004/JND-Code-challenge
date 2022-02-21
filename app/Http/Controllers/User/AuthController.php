<?php

namespace App\Http\Controllers\User;

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
        if(Auth::guard('full')->check() || Auth::guard('user')->check()){
            return redirect('user');
        }
        $data['page_title'] = 'เข้าสู่ระบบ';
        return view('user/auth/login', $data);
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
            if(Hash::check($input_all['password'], $existUser->password) && $existUser->permission == 'full' || Hash::check($input_all['password'], $existUser->password) && $existUser->permission == 'user'){
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

    public function register(){
        $data['page_title'] = 'สมัครสมาชิก';
        return view('user/auth/register', $data);
    }

    public function store(Request $request){
        $input_all = $request->all();
        $validator = Validator::make($input_all, [
            'username' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
        ],[
            'username' => 'username is required',
            'password' => 'password is required',
            'confirm_password' => 'confirm password is required',
        ]);
        $response['statusCode'] = 400;
        $response['status'] = $validator->errors()->first();
        if(!$validator->fails()){
            unset($input_all['confirm_password']);
            $existUser = User::ExistUser($input_all['username'])->first();
            if(sizeof(explode('@', $input_all['username'])) > 1){
                $input_all['email'] = $input_all['username'];
                $input_all['username'] = null;
            }
            $response['statusCode'] = 400;
            $response['status'] = 'มีผู้ใช้ใช้ username "'.(isset($input_all['email']) ? $input_all['email'] : $input_all['username']).'" แล้ว';
            if(!$existUser){
                DB::beginTransaction();
                try {
                    $input_all['created_at'] = now();
                    $input_all['password'] = Hash::make($input_all['password']);
                    User::insert($input_all);
                    DB::commit();
                    $response['statusCode'] = 200;
                    $response['status'] = 'Success';
                } catch (\Throwable $th) {
                    $response['statusCode'] = 500;
                    $response['status'] = $th->getMessage();
                    DB::rollBack();
                }
            }

        }
        return response()->json($response, $response['statusCode']);
    }

    public function logout(){
        if(Auth::guard('full')->check()){
            Auth::guard('full')->logout();
        }else if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
        }
        return redirect('user/login');
    }
}
