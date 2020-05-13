@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Test Map</div>

                    <div class="card-body">
                        <div id="test_map" style="height: 300px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
<script src="{{url('module/core/js/map-engine.js')}}"></script>
<script>
    new BravoMapEngine('test_map',{
        fitBounds:true,
        center:[51.505, -0.09],
        zoom:6,
        ready: function (engineMap) {
            console.log(engineMap);
            engineMap.on('click',function (dataLatLng) {
                console.log(dataLatLng);
                engineMap.clearMarkers();
                engineMap.addMarker([dataLatLng.lat,dataLatLng.lng],{
                    icon_options:{
                       // iconUrl :'http://travelhotel.wpengine.com/wp-content/uploads/2018/11/ico_mapker_hotel.png'
                    }
                });
            })
        }
    });
</script>
@endsection