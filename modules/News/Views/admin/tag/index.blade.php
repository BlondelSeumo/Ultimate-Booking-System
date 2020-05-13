@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __('News Tags')}} </h1>
        </div>
        @include('admin.message')
        <div class="row">
            <div class="col-md-4">
                <div class="panel">
                    <div class="panel-title">{{ __('Add Tag')}}</div>
                    <div class="panel-body">
                        <form action="" method="post">
                            @csrf
                            @include('News::admin/tag/form',['parents'=>$rows])
                            <div class="">
                                <button class="btn btn-primary" type="submit"> {{ __('Add new')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="filter-div d-flex justify-content-between ">
                    <div class="col-left">
                        @if(!empty($rows))
                            <form method="post" action="{{url('admin/module/news/tag/bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                                {{csrf_field()}}
                                <select name="action" class="form-control">
                                    <option value="">{{__(" Bulk Action ")}}</option>
                                    <option value="delete">{{__(" Delete ")}}</option>
                                </select>
                                <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="submit">{{__('Apply')}}</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-left">
                        <form method="get" action="{{url('/admin/module/news/tag/')}} " class="filter-form filter-form-right d-flex justify-content-end" role="search">
                            @csrf
                            <input placeholder="{{__("Search keyword ...")}}" type="text" name="s" value="{{ Request()->s }}" class="form-control">
                            <button class="btn-info btn btn-icon btn_search" id="search-submit" type="submit">{{__('Search Tag')}}</button>
                        </form>
                    </div>
                </div>
                <div class="text-right">
                    <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
                </div>
                <div class="panel">
                    <form action="" class="bravo-form-item">
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th>{{ __('Name')}}</th>
                                    <th>{{ __('Slug')}}</th>
                                    <th>{{ __('Date')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($rows->total() > 0)
                                    @foreach ($rows as $row)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="check-item" name="ids[]" value="{{$row->id}}">
                                            </td>
                                            <td class="title">
                                                <a href="{{url('admin/module/news/tag/edit/'.$row->id)}}">{{ $row->name}}</a>
                                            </td>
                                            <td>{{ $row->slug}}</td>
                                            <td>{{ display_date($row->updated_at)}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">{{__("No data")}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                {{$rows->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
