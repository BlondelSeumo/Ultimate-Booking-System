@extends('layouts.app',['container_class'=>'container-fluid','header_right_menu'=>true])
@section('head')
    <link href="{{ asset('module/tour/css/tour.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css") }}"/>
    <style type="text/css">
        .bravo_topbar, .bravo_footer {
            display: none
        }
    </style>
@endsection
@section('content')
    <div class="bravo_search_tour">
        <div class="bravo_form_search_map">
            @include('Tour::frontend.layouts.search-map.form-search-map')
        </div>
        <div class="bravo_search_map">
            <div class="results_map">
                <div class="map-loading d-none">
                    <div class="st-loader"></div>
                </div>
                <div id="bravo_results_map" class="results_map_inner"></div>
            </div>
            <div class="results_item">
                @include('Tour::frontend.layouts.search-map.advance-filter')
                <div class="listing_items">
                    @include('Tour::frontend.layouts.search-map.list-item')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    {!! App\Helpers\MapEngine::scripts() !!}
    <script>
        var bravo_map_data = {
            markers:{!! json_encode($markers) !!}
        };
    </script>
    <script type="text/javascript" src="{{ asset("libs/ion_rangeslider/js/ion.rangeSlider.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset('module/tour/js/tour-map.js') }}"></script>
@endsection