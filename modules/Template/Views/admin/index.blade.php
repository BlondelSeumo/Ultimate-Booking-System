@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__('Template Management')}}</h1>
            <div class="title-actions">
                <a href="{{url('admin/module/template/create')}}" class="btn btn-primary">{{__('Add new Template')}}</a>
            </div>
        </div>
        @include('admin.message')
        <div class="panel">
            <div class="panel-title">{{__('All templates')}}</div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="60px"><input type="checkbox" class="check-all"></th>
                        <th>{{__('Title')}}</th>
                        <th>{{__('Date')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($rows) > 0)
                        @foreach($rows as $row)
                            <tr>
                                <td><input type="checkbox" class="check-item" name="ids[]" value="{{$row->id}}"></td>
                                <td class="title">
                                    <a href="{{url('admin/module/template/edit/'.$row->id)}}">{{$row->title}}</a>
                                </td>
                                <td>{{$row->updated_at}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">{{__("No data")}}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                {{$rows->links()}}
            </div>
        </div>
    </div>
@endsection
