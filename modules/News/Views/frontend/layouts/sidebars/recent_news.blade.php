<div class="sidebar-widget widget_bloglist">
    <div class="sidebar-title">
        <h4>{{ $item->title }}</h4>
    </div>
    <ul class="thumb-list">
        @php $list_blog = $model_news->with('getCategory')->orderBy('id','desc')->paginate(5) @endphp
        @if($list_blog)
            @foreach($list_blog as $blog)
                <li>
                    @if($image_url = get_file_url($blog->image_id, 'thumb'))
                        <div class="thumb">
                            <a href="{{ $blog->getDetailUrl() }}">
                                {{--<img src="{{ $image_url  }}" alt="{{$blog->title}}">--}}
                                {!! get_image_tag($blog->image_id,'thumb',['class'=>'','alt'=>$blog->title]) !!}

                            </a>
                        </div>
                    @endif
                    <div class="content">
                        @if(!empty($blog->getCategory->name))
                            <div class="cate">
                                <a href="{{asset('news/category/'.$blog->getCategory->slug)}}">
                                    {{$blog->getCategory->name ?? ''}}
                                </a>
                            </div>
                        @endif
                        <h5 class="thumb-list-item-title">
                            <a href="{{ $blog->getDetailUrl() }}">{{$blog->title}}</a>
                        </h5>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</div>
