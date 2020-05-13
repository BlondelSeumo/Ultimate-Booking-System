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
                    <div class="user-form-settings">
                        <div class="breadcrumb-page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i>
                                    <a href="{{url("/user/dashboard")}}">
                                        {{__("Home")}}
                                    </a>
                                    <i class="fa fa-angle-right"></i>
                                </li>
                                <li>&nbsp; {{__("Manage Tours")}} </li>
                            </ul>
                            <div class="bravo-more-menu-user">
                                <i class="icofont-settings"></i>
                            </div>
                        </div>
                        <h2 class="title-bar no-border-bottom">
                            {{$row->id ? 'Edit: '.$row->title : 'Add new tour'}}
                        </h2>
                        @include('admin.message')
                        <form action="" method="post">
                            @csrf
                            <div class="form-add-service">
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                    <a data-toggle="tab" href="#nav-tour-content" aria-selected="true" class="active">{{__("1. Tour Content")}}</a>
                                    <a data-toggle="tab" href="#nav-tour-location" aria-selected="false">{{__("2. Tour Locations")}}</a>
                                    <a data-toggle="tab" href="#nav-tour-pricing" aria-selected="false">{{__("3. Tour Pricing")}}</a>
                                    <a data-toggle="tab" href="#nav-availability" aria-selected="false">{{__("4. Tour Availability")}}</a>
                                    {{--<a data-toggle="tab" href="#nav-seo" aria-selected="false">{{__("5. Tour SEO")}}</a>--}}
                                </div>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-tour-content">
                                        @include('Tour::admin/tour/tour-content')
                                        <div class="form-group">
                                            <label>{{__("Featured Image")}}</label>
                                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="nav-tour-location">
                                        @include('Tour::admin/tour/tour-location')
                                    </div>
                                    <div class="tab-pane fade" id="nav-tour-pricing">
                                        @include('Tour::admin/tour/pricing')
                                    </div>
                                    <div class="tab-pane fade" id="nav-availability">
                                        @include('Tour::admin/tour/availability')
                                    </div>
                                    <div class="tab-pane fade" id="nav-seo">
                                        {{--@include('Core::admin/seo-meta/seo-meta')--}}
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary" type="submit">{{__('Save Changes')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{ asset('js/condition.js') }}"></script>
    <script src="{{url('module/core/js/map-engine.js')}}"></script>
    <script type="text/javascript" src="{{ asset("module/user/js/user.js") }}"></script>
    <script>
        jQuery(function ($) {
            new BravoMapEngine('map_content', {
                fitBounds: true,
                center: [{{$row->map_lat ?? "51.505"}}, {{$row->map_lng ?? "-0.09"}}],
                zoom:{{$row->map_zoom ?? "8"}},
                ready: function (engineMap) {
                    @if($row->map_lat && $row->map_lng)
                    engineMap.addMarker([{{$row->map_lat}}, {{$row->map_lng}}], {
                        icon_options: {}
                    });
                    @endif
                    engineMap.on('click', function (dataLatLng) {
                        engineMap.clearMarkers();
                        engineMap.addMarker(dataLatLng, {
                            icon_options: {}
                        });
                        $("input[name=map_lat]").attr("value", dataLatLng[0]);
                        $("input[name=map_lng]").attr("value", dataLatLng[1]);
                    });
                    engineMap.on('zoom_changed', function (zoom) {
                        $("input[name=map_zoom]").attr("value", zoom);
                    })
                }
            });
        })
    </script>
@endsection