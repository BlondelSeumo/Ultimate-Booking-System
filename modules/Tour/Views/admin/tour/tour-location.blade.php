<div class="panel">
    <div class="panel-title"><strong>{{__("Tour Locations")}}</strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label class="control-label">{{__("Location")}}</label>
            <div class="">
                <select name="location_id" class="form-control">
                    <option value="">{{__("-- Please Select --")}}</option>
                    <?php
                    $traverse = function ($locations, $prefix = '') use (&$traverse, $row) {
                        foreach ($locations as $location) {
                            $selected = '';
                            if ($row->location_id == $location->id)
                                $selected = 'selected';
                            printf("<option value='%s' %s>%s</option>", $location->id, $selected, $prefix . ' ' . $location->name);
                            $traverse($location->children, $prefix . '-');
                        }
                    };
                    $traverse($tour_location);
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Real tour address")}}</label>
            <input type="text" name="address" class="form-control" placeholder="{{__("Real tour address")}}" value="{{$row->address}}">
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Map Engine")}}</label>
            <div class="control-map-group">
                <div id="map_content"></div>
                <div class="g-control">
                    <div class="form-group">
                        <label>{{__("Map Lat")}}:</label>
                        <input type="text" name="map_lat" class="form-control" value="{{$row->map_lat}}" readonly="">
                    </div>
                    <div class="form-group">
                        <label>{{__("Map Lng")}}:</label>
                        <input type="text" name="map_lng" class="form-control" value="{{$row->map_lng}}" readonly>
                    </div>
                    <div class="form-group">
                        <label>{{__("Map Zoom")}}:</label>
                        <input type="text" name="map_zoom" class="form-control" value="{{$row->map_zoom ?? "8"}}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>