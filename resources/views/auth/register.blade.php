@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center bravo-login-form-page bravo-login-page">
            <div class="col-md-5">
                <div class="">
                    <h4 class="form-title">{{ __('Register') }}</h4>
                    @include('auth.register-form',['captcha_action'=>'register_normal'])
                </div>
            </div>
        </div>
    </div>
@endsection
