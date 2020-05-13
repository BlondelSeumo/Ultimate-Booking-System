<div class="article">
    <div class="header">
        @if($image_url = get_file_url($row->image_id, 'full'))
            <header class="post-header">
                <img src="{{ $image_url  }}" alt="{{$row->title}}">
            </header>
            <div class="cate">
                @if(!empty($row->getCategory->name))
                    <ul>
                        <li>
                            <a href="{{asset('news/category/'.$row->getCategory->slug)}}">
                                {{$row->getCategory->name ?? ''}}
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
        @endif
    </div>
    <h2 class="title">{{$row->title}}</h2>
    <div class="post-info">
        <ul>
            <li>
                <span> {{ __('BY ')}} </span>
                {{$row->getAuthor->getDisplayName() ?? ''}}
            </li>
            <li> {{__('DATE ')}}  {{ display_date($row->updated_at)}}  </li>
        </ul>
    </div>
    <div class="post-content"> {!! $row->content !!}</div>
    <div class="space-between">
        @if (!empty($tags = $row->getTags()) and count($tags) > 0)
            <div class="tags">
                {{__("Tags:")}}
                @foreach($tags as $tag)
                    <a href="{{ $tag->getDetailUrl() }}" class="tag-item"> {{$tag->name}} </a>
                @endforeach
            </div>
        @endif
        <div class="share"> {{__("Share")}}
            <a class="facebook share-item" href="https://www.facebook.com/sharer/sharer.php?u={{$row->getDetailUrl()}}&amp;title={{$row->title}}" target="_blank" original-title="{{__("Facebook")}}"><i class="fa fa-facebook fa-lg"></i></a>
            <a class="twitter share-item" href="https://twitter.com/share?url={{$row->getDetailUrl()}}&amp;title={{$row->title}}" target="_blank" original-title="{{__("Twitter")}}"><i class="fa fa-twitter fa-lg"></i></a>
        </div>
    </div>
</div>
 
