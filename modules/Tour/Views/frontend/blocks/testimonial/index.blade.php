@if($list_item)
    <div class="bravo-testimonial">
        <div class="container">
            <h3>{{$title}}</h3>
            <div class="row">
                @foreach($list_item as $item)
                    <?php $avatar_url = get_file_url($item['avatar'], 'full') ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="item has-matchHeight">
                            <div class="author">
                                <img src="{{$avatar_url}}" alt="{{$item['name']}}">
                                <div class="author-meta">
                                    <h4>{{$item['name']}}</h4>
                                    @if($item['number_star'])
                                        <div class="star">
                                            @for($i = 0 ; $i < $item['number_star'] ; $i++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <p>
                                {{$item['desc']}}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif