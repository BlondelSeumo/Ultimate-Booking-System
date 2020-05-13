@extends('admin.layouts.app')
@section('content')
    <form action="" method="post">
        @csrf
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit: ').$row->name : __('Add new category')}}</h1>
                    @if($row->slug)
                        <p class="item-url-demo"> {{ __('Permalink:')}}
                            {{ url("/".config('news.news_route_prefix')."/".config('news.news_category_route_prefix')) }}/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a>
                        </p>
                    @endif
                </div>
                <div class="">
                    @if($row->slug)
                        <a class="btn btn-primary btn-sm" href="{{$row->getDetailUrl()}}"
                           target="_blank"> {{ __('View')}}</a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="panel-body-title"> {{ __('Category Content')}}</h3>
                            @include('News::admin/category/form')
                        </div>
                    </div>
                    @include('Core::admin/seo-meta/seo-meta')
                </div>
                <div class="col-md-3">
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="panel-body-title"> {{ __('Publish')}}</h3>
                            <div class="form-group">
                                <div>
                                    <label><input @if($row->status=='publish') checked @endif type="radio" name="status" value="publish"> {{ __('Publish')}}
                                    </label>
                                </div>
                                <div>
                                    <label><input @if($row->status=='draft') checked @endif type="radio" name="status" value="draft"> {{ __('Draft')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between"><span></span>
                <button class="btn btn-primary" type="submit"> {{ __('Save Change')}}</button>
            </div>
        </div>
    </form>
@endsection
@section ('script.body')
@endsection