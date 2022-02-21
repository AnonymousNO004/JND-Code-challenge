<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(){
        $data['page_title'] = 'หน้าแรก';
        if(Auth::guard('full')->check()){
            $data['username'] = (Auth::guard('full')->user()->username != '' ? Auth::guard('full')->user()->username : Auth::guard('full')->user()->email);
            $data['permission'] = Auth::guard('full')->user()->permission;
        }else if(Auth::guard('admin')->check()){
            $data['username'] = (Auth::guard('admin')->user()->username != '' ? Auth::guard('admin')->user()->username : Auth::guard('admin')->user()->email);
            $data['permission'] = Auth::guard('admin')->user()->permission;
        }else{
            return redirect('admin/login');
        }
        return view('admin/home/home', $data);
    }

    public function lists(Request $request){
        $results = User::select();
        return datatables()->of($results)
        ->addIndexColumn()
        ->addColumn('username_or_email', function($rec){
            $str = '-';
            if($rec->username != ''){
                $str = $rec->username;
            }else if($rec->email){
                $str = $rec->email;
            }
            return $str;
        })
        ->addColumn('actions', function($rec){
            $str = '';
            if(Auth::guard('admin')->user()->id != $rec->id){
                $str .= '<button class="btn mx-1 btn-warning btn-edit" data-id="'.$rec->id.'">แก้ไข</button>';
                $str .= '<button class="btn mx-1 btn-danger btn-delete" data-id="'.$rec->id.'">ลบ</button>';
            }
            return $str;
        })
        ->rawColumns(['actions'])
        ->make(true);
    }

    public function show($id){
        $User = User::find($id);
        $response['statusCode'] = 404;
        $response['status'] = 'Not Found';
        if($User){
            $response['statusCode'] = 200;
            $response['status'] = 'Success';
            $response['results'] = [
                'id' => $User->id,
                'permission' => $User->permission
            ];
        }
        return response()->json($response, $response['statusCode']);
    }

    public function update(Request $request){
        $input_all = $request->all();
        $validator = Validator::make($input_all, [
            'id' => 'required',
            'permission' => 'required',
        ],[
            'id' => 'id is required',
            'permission' => 'permission is required',
        ]);
        $response['statusCode'] = 400;
        $response['status'] = 'Validation failed';
        if(!$validator->fails()){
            DB::beginTransaction();
            try {
                $data_update = [
                    'permission' => $input_all['permission'],
                    'updated_at' => now()
                ];
                User::where('id', $input_all['id'])->update($data_update);
                DB::commit();
                $response['statusCode'] = 200;
                $response['status'] = 'Success';
            } catch (\Throwable $th) {
                DB::rollBack();
                $response['statusCode'] = 500;
                $response['status'] = $th->getMessage();
            }
        }
        return response()->json($response, $response['statusCode']);
    }

    public function destroy($id){
        $response['statusCode'] = 400;
        $response['status'] = 'ไม่สามารถลบตัวเองได้';
        if(Auth::guard('full')->check() && Auth::guard('full')->user()->id != $id ||
        Auth::guard('admin')->check() && Auth::guard('admin')->user()->id != $id){
            DB::beginTransaction();
            try {
                User::where('id', $id)->delete();
                DB::commit();
                $response['statusCode'] = 200;
                $response['status'] = 'Success';
            } catch (\Throwable $th) {
                DB::rollBack();
                $response['statusCode'] = 500;
                $response['status'] = $th->getMessage();
            }
        }
        return response()->json($response, $response['statusCode']);
    }
}
