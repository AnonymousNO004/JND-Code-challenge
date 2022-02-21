<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $data['page_title'] = 'หน้าแรก';
        if(Auth::guard('full')->check()){
            $data['username'] = (Auth::guard('full')->user()->username != '' ? Auth::guard('full')->user()->username : Auth::guard('full')->user()->email);
            $data['permission'] = Auth::guard('full')->user()->permission;
        }else if(Auth::guard('user')->check()){
            $data['username'] = (Auth::guard('user')->user()->username != '' ? Auth::guard('user')->user()->username : Auth::guard('user')->user()->email);
            $data['permission'] = Auth::guard('user')->user()->permission;
        }else{
            return redirect('user/login');
        }
        return view('user/home/home', $data);
    }
}
