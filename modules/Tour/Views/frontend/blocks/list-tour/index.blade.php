<div class="container">
    <div class="bravo-list-tour">
        <div class="title">
            {{$title}}
        </div>
        <div class="list-item">
            @if($style_list === "normal")
                <div class="row">
                    @foreach($rows as $row)
                        <div class="col-lg-3 col-md-6">
                            @include('Tour::frontend.layouts.search.loop-gird')
                        </div>
                    @endforeach
                </div>
            @endif
            @if($style_list === "carousel")
                <div class="owl-carousel">
                    @foreach($rows as $row)
                        @include('Tour::frontend.layouts.search.loop-gird')
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>