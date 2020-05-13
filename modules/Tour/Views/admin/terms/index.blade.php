@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("Attribute: :name",['name'=>$attr->name])}}</h1>
        </div>
        @include('admin.message')
        <div class="row">
            <div class="col-md-4 mb40">
                <div class="panel">
                    <div class="panel-title">{{__("Add Term")}}</div>
                    <div class="panel-body">
                        <form action="{{url('admin/module/tour/attribute/term_store')}}" method="post">
                            @csrf
                            @include('Tour::admin/terms/form')
                            <div class="">
                                <button class="btn btn-primary" type="submit">{{__("Add new")}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-title">{{__("All Terms")}}</div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th width="60px"><input type="checkbox" class="check-all"></th>
                                <th>{{__("Name")}}</th>
                                <th class="date">{{__("Date")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($rows as $row)
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="{{$row->id}}"></td>
                                    <td class="title">
                                        <a href="{{url('admin/module/tour/attribute/term_edit/'.$row->id)}}">{{$row->name}}</a>
                                    </td>
                                    <td>{{ display_date($row->updated_at)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            {{$rows->appends(request()->query())->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
