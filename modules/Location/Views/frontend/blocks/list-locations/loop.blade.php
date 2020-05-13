<div class="destination-item @if(!$row->image_id) no-image  @endif">
    <a href="{{url("/tour?location_id=".$row->id)}}">
        <div class="image" @if($row->image_id) style="background: url({{$row->getImageUrl()}})" @endif >
            <div class="effect"></div>
            <div class="content">
                <h4 class="title">{{$row->name}}</h4>
                <div class="desc">{{$row->getDisplayNumberServiceInLocation($service_type)}}</div>
            </div>
        </div>
    </a>
</div>