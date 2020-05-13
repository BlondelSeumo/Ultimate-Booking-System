@if(count($tour_related) > 0)
    <div class="bravo-list-tour-related">
        <h2>{{__("You might also like")}}</h2>
        <div class="row">
            @foreach($tour_related as $k=>$row)
                <div class="col-md-3">
                    @include('Tour::frontend.layouts.search.loop-gird')
                </div>
            @endforeach
        </div>
    </div>
@endif