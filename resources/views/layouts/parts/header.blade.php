<div class="bravo_header">
    <div class="{{$container_class ?? 'container'}}">
        <div class="content">
            <div class="header-left">
                <a href="{{url('/')}}" class="bravo-logo">
                    @if($logo_id = setting_item("logo_id"))
                        <?php $logo = get_file_url($logo_id,'full') ?>
                        <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                    @endif
                </a>
                <div class="bravo-menu">
                    <?php generate_menu('primary') ?>
                </div>
            </div>
            <div class="header-right">
                @if(!empty($header_right_menu))
                    <ul class="topbar-items">
                        @if(!Auth::id())
                            <li class="login-item">
                                <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Login')}}</a>
                            </li>
                            <li class="signup-item">
                                <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Sign Up')}}</a>
                            </li>
                        @else
                            <li class="login-item dropdown">

                                <a href="#" data-toggle="dropdown" class="is_login">
                                    @if($avatar_url = Auth::user()->getAvatarUrl())
                                        <img class="avatar" src="{{$avatar_url}}" alt="{{ Auth::user()->name}}">
                                    @else
                                        <span class="avatar-text">{{ucfirst( Auth::user()->name[0])}}</span>
                                    @endif
                                    {{__("Hi, :Name",['name'=>Auth::user()->name])}}
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu text-left">
                                    <li><a href="{{url('/user/profile')}}"><i class="icon ion-md-construct"></i> {{__("My profile")}}</a></li>

                                    @if(Auth::user()->hasPermissionTo('dashboard_access'))
                                        <li class="menu-hr"><a href="{{url('/admin')}}"><i class="icon ion-ios-ribbon"></i> {{__("Dashboard")}}</a></li>
                                    @endif
                                    <li class="menu-hr">
                                        <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> {{__('Logout')}}</a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
                @endif
                <button class="bravo-more-menu">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="bravo-menu-mobile">
        <div class="user-profile">
            <div class="b-close"><i class="icofont-scroll-left"></i></div>
            <div class="avatar">
                @if(Auth::id())
                    @php
                        $user_id = Auth::id();
                        $dataUser = \Modules\User\Models\User::find($user_id);
                    @endphp
                    @if($avatar_url = $dataUser->getAvatarUrl())
                        <img src="{{$avatar_url}}" alt="{{$dataUser->name}}">
                    @else
                        <i class="icofont-user-alt-2"></i>
                    @endif
                @else
                    <i class="icofont-user-alt-2"></i>
                @endif
            </div>
            <ul>
                @if(!Auth::id())
                    <li>
                        <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Login')}}</a>
                    </li>
                    <li>
                        <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Sign Up')}}</a>
                    </li>
                @else
                    <li>
                        <a href="{{url('/user/profile')}}">
                            <i class="icofont-user-suited"></i> {{__("Hi, :Name",['name'=>Auth::user()->name])}}
                        </a>
                    </li>
                    <li>
                        <a href="{{url('/user/profile')}}">
                            <i class="icon ion-md-construct"></i> {{__("My profile")}}
                        </a>
                    </li>
                    @if(Auth::user()->hasPermissionTo('dashboard_access'))
                        <li>
                            <a href="{{url('/admin')}}"><i class="icon ion-ios-ribbon"></i> {{__("Dashboard")}}</a>
                        </li>
                    @endif
                    <li>
                        <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> {{__('Logout')}}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
            </ul>
        </div>
        <div class="g-menu">
            <?php generate_menu('primary') ?>
        </div>
    </div>
</div>