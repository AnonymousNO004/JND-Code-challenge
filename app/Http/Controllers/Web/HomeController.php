<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller{

    public function index(){
        $data['page_title'] = 'หน้าแรก';
        return view('web/home/home', $data);
    }
}
