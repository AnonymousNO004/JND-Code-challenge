@extends('layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/user/all.css')}}">
@endsection
@section('body')
    <section class="h-100 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Have an account?</h3>
                        <form id="login">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email or Username" name="username" id="username" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input id="input_password" name="password" type="password" class="form-control" placeholder="Password" required autocomplete="off">
                                <span toggle="#input_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Remember Me
                                        <input type="checkbox" name="remember" checked value="true">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="{{url('user/register')}}" style="color: #fff">Register</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{asset('js/user/auth/login.js')}}"></script>
@endsection
