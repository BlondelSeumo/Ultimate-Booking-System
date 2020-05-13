@extends('admin.layouts.app')
@section('content')

    <form action="" method="post">
        @csrf
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? 'Edit: '.$row->name : 'Add new permission'}}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="panel-body-title">{{ __('Permission Content')}}</h3>
                            <div class="form-group">
                                <label>{{ __('Name')}}</label>
                                <input type="text" value="{{$row->name}}" placeholder="{{ __('Name')}}" name="name" class="form-control">
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