<div class="sidebar-widget widget_search">
    <form method="get" class="search" action="{{ url(config('news.news_route_prefix')) }}">
        <input type="text" class="form-control" value="{{ Request::query("s") }}" name="s" placeholder="{{__("Search ...")}}">
        <button type="submit" class="icon_search"></button>
    </form>
</div>