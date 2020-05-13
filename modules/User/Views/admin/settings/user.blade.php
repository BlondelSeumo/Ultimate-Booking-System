<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Google reCapcha Options")}}</h3>
        <p class="form-group-desc">{{__('Config google recapcha for system')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="" >{{__("Enable reCapcha Login Form")}}</label>
                    <div class="form-controls">
                        <label><input type="checkbox" name="user_enable_login_recaptcha" value="1" @if(!empty($settings['user_enable_login_recaptcha'])) checked @endif /> {{__("On")}} </label>
                        <br>
                        <small class="form-text text-muted">{{__("Turn on the mode for login form")}}</small>
                    </div>
                </div>
                <div class="form-group">
                    <label class="" >{{__("Enable reCapcha Register Form")}}</label>
                    <div class="form-controls">
                        <label><input type="checkbox" name="user_enable_register_recaptcha" value="1"  @if(!empty($settings['user_enable_register_recaptcha'])) checked @endif /> {{__("On")}} </label>
                        <br>
                        <small class="form-text text-muted">{{__("Turn on the mode for register form")}}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Content Email User Registered')}}</h3>
        <div class="form-group-desc">{{ __('Content email send to Customer or Administrator when user registered.')}}
            @foreach(\Modules\User\Listeners\SendMailUserRegisteredListen::CODE as $item=>$value)
                <div><code>{{$value}}</code></div>
                @endforeach
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label> <input type="checkbox" @if($settings['enable_mail_user_registered'] ?? '' == 1) checked @endif name="enable_mail_user_registered" value="1"> {{__("Enable send email to customer when customer registered ?")}}</label>
                </div>
                <div class="form-group" data-condition="enable_mail_user_registered:is(1)">
                    <label >{{__("Content")}}</label>
                    <div class="form-controls">
                        <textarea name="user_content_email_registered" class="d-none has-ckeditor" cols="30" rows="10">{{$settings['user_content_email_registered'] ?? '' }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label> <input type="checkbox" @if($settings['admin_enable_mail_user_registered'] ?? '' == 1) checked @endif name="admin_enable_mail_user_registered" value="1"> {{__("Enable send email to Administrator when customer registered ?")}}</label>
                </div>
                <div class="form-group" data-condition="admin_enable_mail_user_registered:is(1)">
                    <label >{{__("Content")}}</label>
                    <div class="form-controls">
                        <textarea name="admin_content_email_user_registered" class="d-none has-ckeditor" cols="30" rows="10">{{$settings['admin_content_email_user_registered'] ?? '' }}</textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Content Email User Forgot Password')}}</h3>
        <div class="form-group-desc">
            @foreach(\Modules\User\Emails\ResetPasswordToken::CODE as $item=>$value)
                <div><code>{{$value}}</code></div>
            @endforeach
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">

                <div class="form-group" >
                    <label >{{__("Content")}}</label>
                    <div class="form-controls">
                        <textarea name="user_content_email_forget_password" class="d-none has-ckeditor" cols="30" rows="10">{{$settings['user_content_email_forget_password'] ?? '' }}</textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
