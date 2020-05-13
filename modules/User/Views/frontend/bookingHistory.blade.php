@extends('layouts.app')
@section('head')
    <style type="text/css">
        .bravo_topbar, .bravo_header, .bravo_footer {
            display: none;
        }
        html, body, .bravo_wrap, .bravo_user_profile, .row-eq-height > .col-md-3 {
            min-height: 100vh !important;
        }
    </style>
    <link href="{{ asset('module/user/css/user.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="bravo_user_profile">
        <div class="container-fluid">
            <div class="row row-eq-height">
                <div class="col-md-3">
                    @include('User::frontend.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @include('User::frontend.layouts.bookingHistory.index')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script type="text/javascript" src="{{ asset("module/user/js/user.js") }}"></script>
@endsection