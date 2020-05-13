@extends('admin.layouts.app')

@section('content')
    <form action="" method="post">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit: ') .$row->title :  __('Add new page') }}</h1>
                    @if($row->slug)
                        <p class="item-url-demo">{{ __('Permalink: ')}} {{ url( config('page.page_route_prefix') )}}/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a>
                        </p>
                    @endif
                </div>
                <div class="">
                    @if($row->slug)
                        <a class="btn btn-primary btn-sm" href="{{$row->getDetailUrl()}}" target="_blank">{{ __('View page')}}</a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="panel-body-title">{{ __('Page Content')}}</h3>
                            <div class="form-group">
                                <label>{{ __('Title')}}</label>
                                <input type="text" value="{{$row->title}}" placeholder="Page title" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Content')}}</label>
                                <div class="">
                                    <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$row->content}}</textarea>
                                </div>
                            </div>
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
                        <div class="panel-title"><strong>{{__('Template Setting')}}</strong></div>
                        <div class="panel-body">
                            <select name="template_id" class="form-control">
                                <option value="">{{__('-- Select --')}}</option>
                                @if($templates)
                                    @foreach($templates as $template)
                                        <option value="{{$template->id}}" @if($row->template_id == $template->id) selected @endif >{{$template->title}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="panel-body-title">{{ __('Feature Image')}}</h3>
                            <div class="form-group">
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@section ('script.body')
@endsection