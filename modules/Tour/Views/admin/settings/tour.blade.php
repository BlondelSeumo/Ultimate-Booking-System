<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Page Search")}}</h3>
        <p class="form-group-desc">{{__('Config page search of your website')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="" >{{__("Title Page")}}</label>
                    <div class="form-controls">
                        <input type="text" name="tour_page_search_title" value="{{$settings['tour_page_search_title'] ?? ''}}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="" >{{__("Banner Page")}}</label>
                    <div class="form-controls form-group-image">
                        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('tour_page_search_banner',$settings['tour_page_search_banner'] ?? "") !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="" >{{__("Layout Search")}}</label>
                    <div class="form-controls">
                        <select name="tour_layout_search" class="form-control" >
                            <option value="normal" {{ ($settings['tour_layout_search'] ?? '') == 'normal' ? 'selected' : ''  }}>{{__("Normal Layout")}}</option>
                            <option value="map" {{($settings['tour_layout_search'] ?? '') == 'map' ? 'selected' : ''  }}>{{__('Map Layout')}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="" >{{__("SEO Options")}}</label>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#seo_1">{{__("General Options")}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#seo_2">{{__("Share Facebook")}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#seo_3">{{__("Share Twitter")}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" >
                        <div class="tab-pane active" id="seo_1">
                            <div class="form-group" >
                                <label class="control-label">{{__("Seo Title")}}</label>
                                <input type="text" name="tour_page_list_seo_title" class="form-control" placeholder="{{__("Enter title...")}}" value="{{ $settings['tour_page_list_seo_title'] ?? ""}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{__("Seo Description")}}</label>
                                <input type="text" name="tour_page_list_seo_desc" class="form-control" placeholder="{{__("Enter description...")}}" value="{{$settings['tour_page_list_seo_desc'] ?? ""}}">
                            </div>
                            <div class="form-group form-group-image">
                                <label class="control-label">{{__("Featured Image")}}</label>
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('tour_page_list_seo_image', $settings['tour_page_list_seo_image'] ?? "" ) !!}
                            </div>
                        </div>
                        @php $seo_share = !empty($settings['tour_page_list_seo_share']) ? json_decode($settings['tour_page_list_seo_share'],true): false; @endphp
                        <div class="tab-pane" id="seo_2">
                            <div class="form-group">
                                <label class="control-label">{{__("Facebook Title")}}</label>
                                <input type="text" name="tour_page_list_seo_share[facebook][title]" class="form-control" placeholder="{{__("Enter title...")}}" value="{{$seo_share['facebook']['title'] ?? "" }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{__("Facebook Description")}}</label>
                                <input type="text" name="tour_page_list_seo_share[facebook][desc]" class="form-control" placeholder="{{__("Enter description...")}}" value="{{$seo_share['facebook']['desc'] ?? "" }}">
                            </div>
                            <div class="form-group form-group-image">
                                <label class="control-label">{{__("Facebook Image")}}</label>
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('tour_page_list_seo_share[facebook][image]',$seo_share['facebook']['image'] ?? "" ) !!}
                            </div>
                        </div>
                        <div class="tab-pane" id="seo_3">
                            <div class="form-group">
                                <label class="control-label">{{__("Twitter Title")}}</label>
                                <input type="text" name="tour_page_list_seo_share[twitter][title]" class="form-control" placeholder="{{__("Enter title...")}}" value="{{$seo_share['twitter']['title'] ?? "" }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{__("Twitter Description")}}</label>
                                <input type="text" name="tour_page_list_seo_share[twitter][desc]" class="form-control" placeholder="{{__("Enter description...")}}" value="{{$seo_share['twitter']['title'] ?? "" }}">
                            </div>
                            <div class="form-group form-group-image">
                                <label class="control-label">{{__("Twitter Image")}}</label>
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('tour_page_list_seo_share[twitter][image]', $seo_share['twitter']['image'] ?? "" ) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Review Options")}}</h3>
        <p class="form-group-desc">{{__('Config review for tour')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="" >{{__("Write review")}}</label>
                    <div class="form-controls">
                        <label><input type="checkbox" name="tour_enable_review" value="1" @if(!empty($settings['tour_enable_review'])) checked @endif /> {{__("On Review")}} </label>
                        <br>
                        <small class="form-text text-muted">{{__("Turn on the mode for reviewing tour")}}</small>
                    </div>
                </div>
                <div class="form-group" data-condition="tour_enable_review:is(1)">
                    <label class="" >{{__("Enable review after booking")}}</label>
                    <div class="form-controls">
                        <label><input type="checkbox" name="tour_enable_review_after_booking" value="1"  @if(!empty($settings['tour_enable_review_after_booking'])) checked @endif /> {{__("On")}} </label>
                        <br>
                        <small class="form-text text-muted">{{__("ON: Only post a review after booking - Off: Post review without booking")}}</small>
                    </div>
                </div>
                <div class="form-group" data-condition="tour_enable_review:is(1)">
                    <label class="" >{{__("Review approved")}}</label>
                    <div class="form-controls">
                        <label><input type="checkbox" name="tour_review_approved" value="1"  @if(!empty($settings['tour_review_approved'])) checked @endif /> {{__("On approved")}} </label>
                        <br>
                        <small class="form-text text-muted">{{__("ON: Review must be approved by admin - OFF: Review is automatically approved")}}</small>
                    </div>
                </div>
                <div class="form-group" data-condition="tour_enable_review:is(1)">
                    <label class="" >{{__("Review number per page")}}</label>
                    <div class="form-controls">
                        <input type="number" class="form-control" name="tour_review_number_per_page" value="{{ $settings['tour_review_number_per_page'] ?? 5 }}" />
                        <small class="form-text text-muted">{{__("Break comments into pages")}}</small>
                    </div>
                </div>
                <div class="form-group" data-condition="tour_enable_review:is(1)">
                    <label class="" >{{__("Review criteria")}}</label>
                    <div class="form-controls">
                        <div class="form-group-item">
                            <div class="g-items-header">
                                <div class="row">
                                    <div class="col-md-5">{{__("Title")}}</div>
                                    <div class="col-md-1"></div>
                                </div>
                            </div>
                            <div class="g-items">
                                <?php
                                if(!empty($settings['tour_review_stats'])){
                                $social_share = json_decode($settings['tour_review_stats']);
                                ?>
                                @foreach($social_share as $key=>$item)
                                    <div class="item" data-number="{{$key}}">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="text" name="tour_review_stats[{{$key}}][title]" class="form-control" value="{{$item->title}}" placeholder="{{__('Eg: Service')}}">
                                            </div>
                                            <div class="col-md-1">
                                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <?php } ?>
                            </div>
                            <div class="text-right">
                                <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>
                            </div>
                            <div class="g-more hide">
                                <div class="item" data-number="__number__">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <input type="text" __name__="tour_review_stats[__number__][title]" class="form-control" value="" placeholder="{{__('Eg: Service')}}">
                                        </div>
                                        <div class="col-md-1">
                                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>