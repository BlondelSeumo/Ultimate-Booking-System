<div class="bravo-call-to-action">
    <div class="container">
        <div class="context">
            <div class="row">
                <div class="col-md-8">
                    <div class="title">
                        {{$title}}
                    </div>
                    <div class="sub_title">
                        {{$sub_title}}
                    </div>
                </div>
                <div class="col-md-4">
                    @if($link_title)
                        <a class="btn-more" href="{{$link_more}}">
                            {{$link_title}}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
