@extends('layouts.auth')
@section('content')<!-- Login form -->
<form class="login-form" method="post" action="https://starlax.noretest2.com/login">
    <input type="hidden" name="_token" value="w6a6MHgVyelsX7FwxPhkEi0tlHJaP2jJzcZEaMUx">
    <div class="card mb-0" style="background-color:#80C4E9;">
        <div class="card-body">
            <div class="text-center mb-3">
                <img src="#" alt="" style="height:80px;object-fit: contain;">

                <h5 class="mb-0">Login to your account</h5>
                <span class="d-block">Your credentials</span>
            </div>

            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" name="username" class="form-control" placeholder="Username">
                <div class="form-control-feedback">
                    <i class="icon-user text-muted"></i>
                </div>
            </div>

            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="password" name="password" autocomplete="off" class="form-control" placeholder="Password">
                <div class="form-control-feedback">
                    <i class="icon-lock2 text-muted"></i>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary-500 btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
            </div>
        </div>
    </div>
</form>
<!-- /login form -->
@endsection