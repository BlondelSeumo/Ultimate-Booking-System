@extends('admin.layouts.app')

@section('content')
    <form action="{{url('admin/module/user/changepass/'.$row->id)}}" method="post">
        @csrf
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? 'Change Password: '.$row->getDisplayName() : 'Add new user'}}</h1>
                </div>
            </div>
            @include('admin.message')

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-title">
                            @if($row->id)
                                <strong class="">{{ __('Change Password')}}</strong>
                            @else
                                <strong class="">{{ __('Password')}}</strong>
                            @endif
                        </div>
                        <div class="panel-body">

                            @if($row->id and $row->id != $currentUser->id and !$currentUser->hasPermissionTo('user_update') )
                                <div class="form-group">
                                    <label>{{ __('Old Password')}}</label>
                                    <input type="password" value="" placeholder="{{ __('Old Password')}}" name="old_password" class="form-control" >
                                </div>
                            @endif
                            <div class="form-group">
                                <label>{{ __('New password')}}</label>
                                <input type="password" value="" placeholder="{{ __('Password')}}" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Re-Password')}}</label>
                                <input type="password" value="" placeholder="{{ __('Re-Password')}}" name="password_confirmation" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary"> {{ __('Change Password')}} </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
