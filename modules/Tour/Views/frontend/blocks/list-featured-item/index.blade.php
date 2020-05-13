@if($list_item)
    <div class="bravo-featured-item">
        <div class="container">
            <div class="row">
                @foreach($list_item as $item)
                    <?php $image_url = get_file_url($item['icon_image'], 'full') ?>
                    <div class="col-md-4">
                        <div class="featured-item">
                            <div class="image">
                                <img src="{{$image_url}}" class="img-responsive">
                            </div>
                            <div class="content">
                                <h4 class="title">
                                    {{$item['title']}}
                                </h4>
                                <div class="desc">{{$item['sub_title']}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif