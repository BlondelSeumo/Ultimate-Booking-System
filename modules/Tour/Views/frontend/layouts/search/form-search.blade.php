<form action="{{url(config('tour.tour_route_prefix'))}}" class="form bravo_form" method="get">
    <div class="row">
        <div class="col-md-5 border-right">
            <div class="form-group field-detination">
                <i class="field-icon fa icofont-map"></i>
                <div class="dropdown" id="dropdown-destination">
                    <label>{{__("Destination")}}</label>
                    <select name="location_id" class="form-control">
                        <option value="">{{__("Where are you going?")}}</option>
                        <?php
                        $current_location_id = Request::query('location_id');
                        $traverse = function ($locations, $prefix = '') use (&$traverse, $current_location_id) {
                            foreach ($locations as $location) {
                                $selected = '';
                                if ($current_location_id == $location->id)
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
        </div>
        <div class="col-md-5 border-right">
            <div class="form-group form-date-field form-date-search clearfix  has-icon" data-format="DD/MM/YYYY">
                <i class="field-icon icofont-wall-clock"></i>
                <div class="date-wrapper clearfix">
                    <div class="check-in-wrapper">
                        <label>{{__("From - To")}}</label>
                        <div class="render check-in-render">{{Request::query('start',date("d/m/Y"))}}</div>
                        <span> - </span>
                        <div class="render check-out-render">{{Request::query('end',date("d/m/Y",strtotime("+1 day")))}}</div>
                    </div>
                </div>
                <input type="hidden" class="check-in-input" value="{{Request::query('start',date("d/m/Y"))}}" name="start">
                <input type="hidden" class="check-out-input" value="{{Request::query('end',date("d/m/Y",strtotime("+1 day")))}}" name="end">
                <input type="text" class="check-in-out" name="date" value="{{Request::query('date')}}">
            </div>
        </div>
        <div class="col-md-2">
            <div class="g-button-submit">
                <button class="btn btn-primary btn-search" type="submit">{{__("Search")}}</button>
            </div>
        </div>
    </div>
</form>