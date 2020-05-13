<aside class="sidebar-right">
    @php
        $list_sidebars = setting_item("news_sidebar");
    @endphp
    @if($list_sidebars)
        @php
            $list_sidebars = json_decode($list_sidebars);
        @endphp
        @foreach($list_sidebars as $item)
            @include('News::frontend.layouts.sidebars.'.$item->type)
        @endforeach
    @endif
</aside>