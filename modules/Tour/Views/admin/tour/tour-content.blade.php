<div class="panel">
    <div class="panel-title"><strong>{{__("Tour Content")}}</strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label>{{__("Title")}}</label>
            <input type="text" value="{{$row->title}}" placeholder="{{__("Tour title")}}" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Content")}}</label>
            <div class="">
                <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$row->content}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Description")}}</label>
            <div class="">
                <textarea name="short_desc" class="form-control" cols="30" rows="4">{{$row->short_desc}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Category")}}</label>
            <div class="">
                <select name="category_id" class="form-control">
                    <option value="">{{__("-- Please Select --")}}</option>
                    <?php
                    $traverse = function ($categories, $prefix = '') use (&$traverse, $row) {
                        foreach ($categories as $category) {
                            $selected = '';
                            if ($row->category_id == $category->id)
                                $selected = 'selected';
                            printf("<option value='%s' %s>%s</option>", $category->id, $selected, $prefix . ' ' . $category->name);
                            $traverse($category->children, $prefix . '-');
                        }
                    };
                    $traverse($tour_category);
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Youtube Video")}}</label>
            <input type="text" name="video" class="form-control" value="{{$row->video}}" placeholder="{{__("Youtube link video")}}">
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Duration")}}</label>
            <input type="text" name="duration" class="form-control" value="{{$row->duration}}" placeholder="{{__("Duration")}}">
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">{{__("Tour Min People")}}</label>
                    <input type="text" name="min_people" class="form-control" value="{{$row->min_people}}" placeholder="{{__("Tour Min People")}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">{{__("Tour Max People")}}</label>
                    <input type="text" name="max_people" class="form-control" value="{{$row->max_people}}" placeholder="{{__("Tour Max People")}}">
                </div>
            </div>
        </div>
        <div class="form-group-item">
            <label class="control-label">{{__('FAQs')}}</label>
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-5">{{__("Title")}}</div>
                    <div class="col-md-5">{{__('Content')}}</div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                @if(!empty($row->faqs))
                    @foreach($row->faqs as $key=>$faq)
                        <div class="item" data-number="{{$key}}">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" name="faqs[{{$key}}][title]" class="form-control" value="{{$faq['title']}}" placeholder="{{__('Eg: When and where does the tour end?')}}">
                                </div>
                                <div class="col-md-6">
                                    <textarea name="faqs[{{$key}}][content]" class="form-control" placeholder="...">{{$faq['content']}}</textarea>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="text-right">
                <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>
            </div>
            <div class="g-more hide">
                <div class="item" data-number="__number__">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" __name__="faqs[__number__][title]" class="form-control" placeholder="{{__('Eg: When and where does the tour end?')}}">
                        </div>
                        <div class="col-md-6">
                            <textarea __name__="faqs[__number__][content]" class="form-control" placeholder="..."></textarea>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">{{__("Banner Image")}}</label>
            <div class="form-group-image">
                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('banner_image_id',$row->banner_image_id) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Gallery")}}</label>
            {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery) !!}
        </div>

    </div>
</div>