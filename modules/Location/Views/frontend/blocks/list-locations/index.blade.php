<div class="container">
    <div class="bravo-list-locations">
        <div class="title">
            {{$title}}
        </div>
        <div class="list-item">
            <div class="row">
                @foreach($rows as $key=>$row)
                    <div class="col-lg-<?php if($key == 0) echo 8; else echo 4; ?>">
                        @include('Location::frontend.blocks.list-locations.loop')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>