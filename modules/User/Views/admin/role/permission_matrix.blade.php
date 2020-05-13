@extends('admin.layouts.app')
@section('content')
    <form action="{{url('admin/module/user/role/save_permissions')}}" method="post">
        @csrf
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{ __('Permission Matrix')}}</h1>
                </div>
            </div>
            @include('admin.message')
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <td><strong>{{ __('Role')}}</strong></td>
                                        @foreach($roles as $role)
                                            <td><strong>{{ucfirst($role->name)}}</strong></td>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($permissions_group as $gName=>$permissions)
                                        <tr class="">
                                            <td>
                                                <strong>{{ucfirst($gName)}}</strong>
                                            </td>
                                            @foreach($roles as $role)
                                                <td></td>
                                            @endforeach
                                        </tr>
                                        @if(!empty($permissions))
                                            @foreach($permissions as $permission)
                                                <tr>
                                                    <td>{{$permission->name}}</td>
                                                    @foreach($roles as $role)
                                                        <td>
                                                            <input type="checkbox" @if(in_array($permission->id,$selectedIds[$role->id])) checked @endif name="matrix[{{$role->id}}][]" value="{{$permission->id}}">
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>&nbsp;</span>
                        <button class="btn btn-primary" type="submit">{{ __('Save Change')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section ('script.body')
@endsection