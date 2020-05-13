@extends('admin.layouts.app')
@section('content')
    <form action="{{url('/admin/module/user/subscriber/store')}}" method="post">
        <input type="hidden" name="id" value="{{$row->id}}">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    @include('admin.message')
                    <div class="d-flex justify-content-between mb20">
                        <div class="">
                            <h1 class="title-bar">{{$row->id ? __('Edit: ').$row->email : __('Add new subscriber')}}</h1>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="panel-body-title">{{__("Subscriber Info")}}</h3>
                            @include('User::newsletter/subscriber/form')
                        </div>

                    </div>
                    <hr>
                    <div class="text-right">
                        <button class="btn btn-primary" type="submit">{{__("Save changes")}}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section ('script.body')
@endsection
