<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{$html_class ?? ''}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{url('images/favicon.png')}}" />
    @include('layouts.parts.seo-meta')
    <link href="{{ asset('libs/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/daterange/daterangepicker.css") }}" >
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel='stylesheet' id='google-font-css-css'  href='https://fonts.googleapis.com/css?family=Poppins%3A400%2C500%2C600' type='text/css' media='all' />
    <script>
        var bookingCore = {
            url:'{{url('/')}}',
            booking_decimals:{{(int)setting_item('currency_no_decimal',2)}},
            thousand_separator:'{{setting_item('currency_thousand')}}',
            decimal_separator:'{{setting_item('currency_decimal')}}',
            currency_position:'{{setting_item('currency_format')}}',
            currency_symbol:'{{currency_symbol()}}',
            date_format:'{{get_moment_date_format()}}',
            map_provider:'{{setting_item('map_provider')}}',
            map_gmap_key:'{{setting_item('map_gmap_key')}}',
        };
    </script>
    <!-- Styles -->
    @yield('head')
    {{--Custom Style--}}
    @include('layouts.parts.custom-css')
    <link href="{{ asset('libs/carousel-2/owl.carousel.css') }}" rel="stylesheet">
</head>
<body class="{{$body_class ?? ''}}">
    <div class="bravo_wrap">
{{--        @include('layouts.parts.adminbar')--}}
        @include('layouts.parts.topbar')
        @include('layouts.parts.header')
        @yield('content')
        @include('layouts.parts.footer')
    </div>
</body>
</html>
