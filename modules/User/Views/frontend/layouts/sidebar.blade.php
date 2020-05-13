<?php
$dataUser = Auth::user();
$menus = [
    [
        'url'        => '/user/dashboard',
        'title'      => __("Dashboard"),
        'icon'       => 'fa fa-home',
        'permission' => 'dashboard_vendor_access',
    ],
    [
        'url'   => '/user/profile',
        'title' => __("Settings"),
        'icon'  => 'fa fa-cogs',
    ],
    /*[
        'url'=>'/user/wishlist',
        'title'=>__("Wishlist"),
        'icon'=>'fa fa-heart-o',
    ],*/
    [
        'url'   => '/user/booking-history',
        'title' => __("Booking History"),
        'icon'  => 'fa fa-clock-o',
    ],
    [
        'url'        => '/user/tour',
        'title'      => __("Manage Tour"),
        'icon'       => 'fa fa-cogs',
        'permission' => 'tour_view',
        'children'   => [
            [
                'url'   => '/user/tour',
                'title' => "All Tours",
            ],
            [
                'url'        => '/user/tour/create',
                'title'      => "Add Tour",
                'permission' => 'tour_create',
            ],
        ]
    ],
];
$currentUrl = url(Illuminate\Support\Facades\Route::current()->uri());
if (!empty($menus))
    foreach ($menus as $k => $menuItem) {
        if (!empty($menuItem['permission']) and !Auth::user()->hasPermissionTo($menuItem['permission'])) {
            unset($menus[$k]);
            continue;
        }
        $menus[$k]['class'] = $currentUrl == url($menuItem['url']) ? 'active' : '';
        if (!empty($menuItem['children'])) {
            $menus[$k]['class'] .= ' has-children';
            foreach ($menuItem['children'] as $k2 => $menuItem2) {
                if (!empty($menuItem2['permission']) and !Auth::user()->hasPermissionTo($menuItem2['permission'])) {
                    unset($menus[$k]['children'][$k2]);
                    continue;
                }
                $menus[$k]['children'][$k2]['class'] = $currentUrl == url($menuItem2['url']) ? 'active active_child' : '';
            }
        }
    }
?>
<div class="sidebar-user">
    <div class="bravo-close-menu-user"><i class="icofont-scroll-left"></i></div>
    <div class="logo">
        @if($avatar_url = $dataUser->getAvatarUrl())
            <div class="avatar"><img src="{{$avatar_url}}" alt="{{$dataUser->getDisplayName()}}"></div>
        @else
            <span class="avatar-text">{{ucfirst($dataUser->getDisplayName()[0])}}</span>
        @endif
    </div>
    <div class="user-profile-avatar">
        <div class="info-new">
            <h5>{{$dataUser->getDisplayName()}}</h5>
            <p>{{ __("Member Since :time" , ['time'=> date("M Y",strtotime($dataUser->created_at))]) }}</p>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="main-menu">
            @foreach($menus as $menuItem)
                <li class="{{$menuItem['class']}}">
                    <a href="{{ url($menuItem['url']) }}">
                        @if(!empty($menuItem['icon']))
                            <span class="icon text-center"><i class="{{$menuItem['icon']}}"></i></span>
                        @endif
                        {{$menuItem['title']}}

                    </a>
                    @if(!empty($menuItem['children']))
                        <i class="caret"></i>
                    @endif
                    @if(!empty($menuItem['children']))
                        <ul class="children">
                            @foreach($menuItem['children'] as $menuItem2)
                                <li class="{{$menuItem2['class']}}"><a href="{{ url($menuItem2['url']) }}">
                                        @if(!empty($menuItem2['icon']))
                                            <i class="{{$menuItem2['icon']}}"></i>
                                        @endif
                                        {{$menuItem2['title']}}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <div class="logout">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> {{__("Log Out")}}
        </a>
    </div>
    <div class="logout">
        <a href="{{url('/')}}"><i class="fa fa-long-arrow-left"></i> {{__("Back to Homepage")}}</a>
    </div>
</div>
