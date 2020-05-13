<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Checkout Page')}}</h3>
        <p class="form-group-desc">{{__('Change your checkout page options')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="" >{{__("Enable reCapcha Booking Form")}}</label>
                    <div class="form-controls">
                        <label><input type="checkbox" name="booking_enable_recaptcha" value="1" @if(!empty($settings['booking_enable_recaptcha'])) checked @endif /> {{__("On ReCapcha")}} </label>
                        <br>
                        <small class="form-text text-muted">{{__("Turn on the mode for booking form")}}</small>
                    </div>
                </div>
                <div class="form-group">
                    <label >{{__("Terms & Conditions page")}}</label>
                    <div class="form-controls">
                        <?php
                            $template = !empty($settings['booking_term_conditions']) ? \Modules\Page\Models\Page::find($settings['booking_term_conditions'] ) : false;
                            \App\Helpers\AdminForm::select2('booking_term_conditions',[
                            'configs'=>[
                                    'ajax'=>[
                                        'url'=>url('/admin/module/page/getForSelect2'),
                                        'dataType'=>'json'
                                    ]
                                ]
                            ],
                            !empty($template->id) ? [$template->id,$template->title] :false
                            )
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Booking Email')}}</h3>
        <p class="form-group-desc">{{__('Change booking email header and footer')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label >{{__("Header")}}</label>
                    <div class="form-controls">
                        <textarea name="email_header" class="d-none has-ckeditor" cols="30" rows="10">{{$settings['email_header'] ?? '' }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label >{{__("Footer")}}</label>
                    <div class="form-controls">
                        <textarea name="email_footer" class="d-none has-ckeditor" cols="30" rows="10">{{$settings['email_footer'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
