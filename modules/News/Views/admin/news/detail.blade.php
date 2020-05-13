@extends('admin.layouts.app')

@section('content')
    <form action="" method="post" class="dungdt-form">
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit post: ').$row->title : __('Add new Post')}}</h1>
                    @if($row->slug)
                        <p class="item-url-demo">{{__("Permalink")}}: {{ url( config('news.news_route_prefix'))  }}/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a>
                        </p>
                    @endif
                </div>
                <div class="">
                    @if($row->slug)
                        <a class="btn btn-primary btn-sm" href="{{$row->getDetailUrl()}}" target="_blank">{{__("View Post")}}</a>
                    @endif
                </div>
            </div>
            @include('admin.message')
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-title"><strong>{{ __('News content')}}</strong></div>
                        <div class="panel-body">
                            @csrf
                            @include('News::admin/news/form',['parents'=>$rows, 'row'=>$row])
                        </div>
                    </div>
                    @include('Core::admin/seo-meta/seo-meta')
                </div>
                <div class="col-md-3">
                    <div class="panel">
                        <div class="panel-title"><strong>{{__('Publish')}}</strong></div>
                        <div class="panel-body">
                            <div>
                                <label><input @if($row->status=='publish') checked @endif type="radio" name="status" value="publish"> {{__("Publish")}}
                                </label></div>
                            <div>
                                <label><input @if($row->status=='draft') checked @endif type="radio" name="status" value="draft"> {{__("Draft")}}
                                </label></div>
                            <div class="text-right">
                                <button class="btn btn-primary" type="submit">{{__('Save Changes')}}</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="panel-body-title"> {{ __('Feature Image')}}</h3>
                            <div class="form-group">
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label"> {{ __('Tag')}}</label>
                                <div class="">
                                    <input type="text" data-role="tagsinput" value="{{$row->tag}}" placeholder="{{ __('Enter tag')}}" name="tag" class="form-control tag-input">
                                    <br>
                                    <div class="show_tags">
                                        @if(!empty($tags))
                                            @foreach($tags as $tag)
                                                <span class="tag_item">{{$tag->name}}<span data-role="remove"></span>
                                                    <input type="hidden" name="tag_ids[]" value="{{$tag->id}}">
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
