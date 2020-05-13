<?php
if (!Auth::id() or !Auth::user()->hasPermissionTo('dashboard_access'))
    return;
$activeMenu = \Modules\Core\Walkers\MenuWalker::getActiveMenu();
?>
<div class="bravo-admin-bar">
    <div class="container">
        <ul class="adminbar-menu">
            <li><a href="{{url('/admin')}}"><i class="icon ion-ios-desktop"></i> {{__("Dashboard")}}</a></li>
            @if(is_object($activeMenu))
                <li><a href="{{$activeMenu->getEditUrl()}}"><i class="icon ion-ios-brush"></i> {{__("Edit")}}</a></li>
            @endif
        </ul>
    </div>
</div>
