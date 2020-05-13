<div class="bravo_topbar">
    <div class="container">
        <div class="content">
            <div class="topbar-left">
                @if($social_share = setting_item("social_share"))
                    <?php $social_share = json_decode($social_share); ?>
                    <div class="st-list socials">
                        @foreach($social_share as $key=>$item)
                            <a href="{{$item->link}}" target="_blank">
                                <i class="{{$item->class_icon}}"></i>
                            </a>
                        @endforeach
                    </div>
                @endif
                @if($admin_email = setting_item("admin_email"))
                    <ul class="topbar-items">
                        <li class="hidden-xs hidden-sm"><a href="mailto:{{$admin_email}}" target="">{{$admin_email}}</a>
                        </li>
                    </ul>
                @endif
            </div>
            <div class="topbar-right">
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
                            <a href="#" data-toggle="dropdown" class="login">{{__("Hi, :Name",['name'=>Auth::user()->getDisplayName()])}}
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu text-left">
                                <li><a href="{{url('/user/profile')}}"><i class="icon ion-md-construct"></i> {{__("My profile")}}</a></li>

                                @if(Auth::user()->hasPermissionTo('dashboard_access'))
                                    <li class="menu-hr"><a href="{{url('/admin')}}"><i class="icon ion-ios-ribbon"></i> {{__("Dashboard")}}</a></li>
                                @endif
                                <li class="menu-hr">
                                    <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fa fa-sign-out"></i> {{__('Logout')}}</a>
                                </li>
                            </ul>
                            <form id="logout-form-topbar" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
