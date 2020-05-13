@foreach($rows as $row)
    <div class="post_item ">
        <div class="header">
            @if($image_url = get_file_url($row->image_id, 'full'))
                <header class="post-header">
                    {!! get_image_tag($row->image_id,'full') !!}
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
            <div class="post-inner">
                <h4 class="post-title">
                    <a class="text-darken" href="{{$row->getDetailUrl()}}"> {{$row->title}}</a>
                </h4>
                <div class="post-info">
                    <ul>
                        <li>
                            @if($avatar_url = $row->getAuthor->getAvatarUrl())
                                <img class="avatar" src="{{$avatar_url}}" alt="{{$row->getAuthor->getDisplayName}}">
                            @else
                                <span class="avatar-text">{{ucfirst($row->getAuthor->getDisplayName()[0])}}</span>
                            @endif
                            <span> {{ __('BY ')}} </span>
                            {{$row->getAuthor->getDisplayName() ?? ''}}
                        </li>
                        <li> {{__('DATE ')}}  {{ display_date($row->updated_at)}}  </li>
                    </ul>
                </div>
                <div class="post-desciption">
                    {{ get_exceprt($row->content) }}
                </div>
                <a class="btn-readmore" href="{{$row->getDetailUrl()}}">{{ __('Read More')}}</a>
            </div>
        </div>
    </div>
@endforeach
