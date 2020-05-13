@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__('Menu Management')}}</h1>
            <div class="title-actions">
                <a href="{{url('admin/module/core/menu/create')}}" class="btn btn-primary">{{__("Add new")}}</a>
            </div>
        </div>
        @include('admin.message')
        <div class="panel">
            <div class="panel-title">{{__('All Menus')}}</div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="60px"><input type="checkbox" class="check-all"></th>
                        <th>{{__('Title')}}</th>
                        <th>{{__("Use for")}}</th>
                        <th>{{__('Date')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $row)
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="{{$row->id}}"></td>
                            <td>
                                <a href="{{url('admin/module/core/menu/edit/'.$row->id)}}">{{$row->name}}</a>
                            </td>
                            <td>
                                @foreach($menu_locations as $l=>$menu_id)
                                    @if($menu_id == $row->id and isset($locations[$l]))
                                        {{$locations[$l]}}<br>
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$row->updated_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$rows->links()}}
            </div>
        </div>
    </div>
@endsection
