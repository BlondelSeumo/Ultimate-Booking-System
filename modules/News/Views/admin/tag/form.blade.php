<div class="form-group">
    <label>{{ __('Name')}}</label>
    <input type="text" value="{{$row->name}}" placeholder=" {{ __('Tag name')}}" name="name" class="form-control">
</div>
<div class="form-group">
    <label>{{ __('Slug')}}</label>
    <input type="text" value="{{$row->slug}}" placeholder=" {{ __('Tag Slug')}}" name="slug" class="form-control">
</div>
<div class="form-group">
    <label class="control-label">{{ __('Description')}}</label>
    <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$row->content}}</textarea>
</div>