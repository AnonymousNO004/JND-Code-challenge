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
                <h3 class="mb-4 text-center">Register</h3>
                <form id="register">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Email or Username" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input id="password-field" name="password" type="password" class="form-control" placeholder="Password" required minlength="8" autocomplete="off">
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <input id="confirm-password-field" name="confirm_password" type="password" class="form-control" placeholder="Comfirm Password" required minlength="8" autocomplete="off">
                        <span toggle="#confirm-password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary submit px-3">Submit</button>
                    </div>
                    <div class="form-group d-md-flex">
                        <div class="w-100 text-md-right">
                            <a href="{{url('user/login')}}" style="color: #fff">Have an account?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{asset('js/user/auth/register.js')}}"></script>
@endsection
