<form action="" class="form bravo_form container-fluid" method="get">
    <div class="row">
        <div class="col-md-5 border-right">
            <div class="form-group field-detination">
                <i class="input-icon field-icon fa">
                    <svg height="24px" width="24px" viewBox="0 0 17 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                            <g id="Search_Result_1_Grid" transform="translate(-165.000000, -328.000000)" stroke="#A0A9B2">
                                <g id="form_search_hotel_row" transform="translate(135.000000, 290.000000)">
                                    <g id="input" transform="translate(30.000000, 0.000000)">
                                        <g id="where" transform="translate(0.000000, 26.000000)">
                                            <g id="Group" transform="translate(0.000000, 12.000000)">
                                                <g id="ico_maps_search_box">
                                                    <path d="M15.75,8.25 C15.75,12.471 12.817,14.899 10.619,17.25 C9.303,18.658 8.25,23.25 8.25,23.25 C8.25,23.25 7.2,18.661 5.887,17.257 C3.687,14.907 0.75,12.475 0.75,8.25 C0.75,4.10786438 4.10786438,0.75 8.25,0.75 C12.3921356,0.75 15.75,4.10786438 15.75,8.25 Z" id="Shape"></path>
                                                    <circle id="Oval" cx="8.25" cy="8.25" r="3"></circle>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg></i>
                <div class="dropdown" data-toggle="dropdown" id="dropdown-destination">
                    <label><?php echo e(__("Destination")); ?></label>
                    <select name="location_id" class="form-control">
                        <option value=""><?php echo e(__("Where are you going?")); ?></option>
                        <?php
                            $current_location_id = Request::query('location_id') ;
                            $traverse = function ($locations, $prefix ='') use (&$traverse,$current_location_id) {
                                foreach ($locations as $location) {
                                    $selected = '';
                                    if($current_location_id == $location->id) $selected = 'selected';
                                    printf("<option value='%s' %s>%s</option>",$location->id,$selected,$prefix.' '.$location->name);
                                    $traverse($location->children, $prefix.'-');
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
                <i class="input-icon field-icon fa">
                    <svg height="24px" width="24px" viewBox="0 0 24 25" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                            <g id="Search_Result_1_Grid" transform="translate(-436.000000, -328.000000)" stroke="#A0A9B2">
                                <g id="form_search_hotel_row" transform="translate(135.000000, 290.000000)">
                                    <g id="input" transform="translate(30.000000, 0.000000)">
                                        <g id="check-in" transform="translate(270.000000, 26.000000)">
                                            <g id="ico_calendar_search_box" transform="translate(1.000000, 12.000000)">
                                                <g id="calendar-add-1">
                                                    <path d="M9.5,18.5 L1.5,18.5 C0.94771525,18.5 0.5,18.0522847 0.5,17.5 L0.5,3.5 C0.5,2.94771525 0.94771525,2.5 1.5,2.5 L19.5,2.5 C20.0522847,2.5 20.5,2.94771525 20.5,3.5 L20.5,10" id="Shape"></path>
                                                    <path d="M5.5,0.501 L5.5,5.501" id="Shape"></path>
                                                    <path d="M15.5,0.501 L15.5,5.501" id="Shape"></path>
                                                    <path d="M0.5,7.501 L20.5,7.501" id="Shape"></path>
                                                    <circle id="Oval" cx="17.5" cy="17.501" r="6"></circle>
                                                    <path d="M17.5,14.501 L17.5,20.501" id="Shape"></path>
                                                    <path d="M20.5,17.501 L14.5,17.501" id="Shape"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </i>
                <div class="date-wrapper clearfix">
                    <div class="check-in-wrapper">
                        <label><?php echo e(__("From - To")); ?></label>
                        <div class="render check-in-render"><?php echo e(Request::query('start',date("d/m/Y"))); ?></div>
                        <span> - </span>
                        <div class="render check-out-render"><?php echo e(Request::query('end',date("d/m/Y",strtotime("+1 day")))); ?></div>
                    </div>
                </div>
                <input type="hidden" class="check-in-input" value="<?php echo e(Request::query('start',date("d/m/Y"))); ?>" name="start">
                <input type="hidden" class="check-out-input" value="<?php echo e(Request::query('end',date("d/m/Y",strtotime("+1 day")))); ?>" name="end">
                <input type="text" class="check-in-out" name="date" value="<?php echo e(Request::query('date')); ?>">
            </div>
        </div>
        <div class="col-md-2">
            <div class="g-button-submit">
                <button class="btn btn-primary btn-search" type="submit"><?php echo e(__("Search")); ?></button>
            </div>
        </div>
    </div>
</form><?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/frontend/layouts/search/form-search-map.blade.php ENDPATH**/ ?>