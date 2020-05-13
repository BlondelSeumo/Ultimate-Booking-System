<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page_title ?? 'Dashboard'}} - {{setting_item('site_title') ?? 'Booking Core'}}</title>
    <link rel="icon" type="image/png" href="{{url('images/favicon.png')}}" />

    <meta name="robots" content="noindex, nofollow" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/flags/css/flag-icon.min.css') }}" rel="stylesheet">

    <link href="{{ asset('dist/admin/css/vendors.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/admin/css/app.css') }}" rel="stylesheet">

    <script>
        var bookingCore  = {
            url:'{{url('/')}}',
            map_provider:'{{setting_item('map_provider')}}',
            map_gmap_key:'{{setting_item('map_gmap_key')}}',
            csrf:'{{csrf_token()}}'
        };
    </script>
    @yield('script.head')

</head>
<body>
<div id="app">
    <div class="main-header d-flex">
        @include('admin.layouts.parts.header')
    </div>
    <div class="main-sidebar">
        @include('admin.layouts.parts.sidebar')
    </div>
    <div class="main-content">
        @include('admin.layouts.parts.bc')
        @yield('content')
        <footer class="main-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 copy-right" >
                        {{date('Y')}} &copy; Booking Core by <a href="https://www.bookingcore.org" target="_blank">BookingCore Team</a>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="https://www.bookingcore.org" target="_blank">About Us</a>
                            <a href="https://m.me/bookingcore" target="_blank">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <div class="backdrop-sidebar-mobile"></div>
</div>

@include('Media::browser')

<!-- Scripts -->


<script src="{{ asset('dist/admin/js/manifest.js') }}" ></script>
<script src="{{ asset('dist/admin/js/vendor.js') }}" ></script>
<script src="{{ asset('libs/tinymce/js/tinymce/tinymce.min.js') }}" ></script>

<script src="{{ asset('dist/admin/js/app.js') }}" ></script>

<script src="{{ asset('libs/select2/js/select2.min.js') }}" ></script>

@yield('script.body')

</body>
</html>
