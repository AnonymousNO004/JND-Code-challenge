@extends('layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/user/all.css')}}">
@endsection
@section('body')
    <section class="h-100 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 rounded-lg bg-white text-center p-5">
                    <span>
                        Hello : {{$username}} <br/>
                        Permission : {{$permission}} <br/>
                    </span>
                    <div class="w-100 my-3">
                        <a class="btn btn-primary" href="{{url('user/logout')}}">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
