@extends('layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/web/all.css')}}">
@endsection
@section('body')
    <div class="h-100 align-items-center d-flex">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 mx-auto bg-white rounded-lg p-5 text-center">
                    <div class="my-3">
                        <a class="btn w-100 btn-warning" href="{{url('admin')}}">Admin</a>
                    </div>
                    <div class="my-3">
                        <a class="btn w-100 btn-primary" href="{{url('user')}}">User</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
