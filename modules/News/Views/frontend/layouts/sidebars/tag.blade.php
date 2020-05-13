<div class="sidebar-widget widget_tag_cloud">
    <div class="sidebar-title"><h4>{{ $item->title }}</h4></div>
    <div class="tagcloud">
        @php
            $list_tags = $model_tag->limit(20)->get();
        @endphp
        <ul>
            @if($list_tags)
                @foreach($list_tags as $tag)
                    <a href="{{ url("/news/tag/".$tag->slug) }}" class="tag-cloud-link">{{$tag->name}}</a>
                @endforeach
            @endif
        </ul>
    </div>
</div>