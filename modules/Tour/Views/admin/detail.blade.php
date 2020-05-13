@extends('admin.layouts.app')

@section('content')
    <form action="" method="post">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit: ').$row->title : __('Add new tour')}}</h1>
                    @if($row->slug)
                        <p class="item-url-demo">{{__("Permalink")}}: {{ url(config('tour.tour_route_prefix') ) }}/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a>
                        </p>
                    @endif
                </div>
                <div class="">
                    @if($row->slug)
                        <a class="btn btn-primary btn-sm" href="{{$row->getDetailUrl()}}" target="_blank">{{__("View Tour")}}</a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    @include('Tour::admin/tour/tour-content')
                    @include('Tour::admin/tour/tour-location')
                    @include('Tour::admin/tour/pricing')
                    @include('Tour::admin/tour/availability')
                    @include('Core::admin/seo-meta/seo-meta')
                </div>
                <div class="col-md-3">
                    <div class="panel">
                        <div class="panel-title"><strong>{{__('Publish')}}</strong></div>
                        <div class="panel-body">
                            <div>
                                <label><input @if($row->status=='publish') checked @endif type="radio" name="status" value="publish"> {{__("Publish")}}
                                </label></div>
                            <div>
                                <label><input @if($row->status=='draft') checked @endif type="radio" name="status" value="draft"> {{__("Draft")}}
                                </label></div>
                            <div class="text-right">
                                <button class="btn btn-primary" type="submit">{{__('Save Changes')}}</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-title"><strong>{{__("Tour Featured")}}</strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <input type="checkbox" name="is_featured" @if($row->is_featured) checked @endif value="1"> {{__("Enable featured")}}
                            </div>
                        </div>
                    </div>
                    @include('Tour::admin/tour/attributes')
                    <div class="panel">
                        <div class="panel-title"><strong>{{__('Feature Image')}}</strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section ('script.body')
    {!! App\Helpers\MapEngine::scripts() !!}
    <script>
        jQuery(function ($) {
            new BravoMapEngine('map_content', {
                disableScripts: true,
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