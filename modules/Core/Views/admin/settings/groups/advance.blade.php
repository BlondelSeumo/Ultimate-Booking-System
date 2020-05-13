<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Map Provider")}}</h3>
        <p class="form-group-desc">{{__('Change map provider of your website')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label>{{__("Map Provider")}}</label>
                    <div class="form-controls">
                        <select name="map_provider" class="form-control" >
                            <option value="osm" {{ ($settings['map_provider'] ?? '') == 'osm' ? 'selected' : ''  }}>{{__("OpenStreetMap.org")}}</option>
                            <option value="gmap" {{($settings['map_provider'] ?? '') == 'gmap' ? 'selected' : ''  }}>{{__('Google Map')}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" data-condition="map_provider:is(gmap)">
                    <label>{{__("Gmap API Key")}}</label>
                    <div class="form-controls">
                        <input type="text" name="map_gmap_key" value="{{$settings['map_gmap_key'] ?? ''}}" class="form-control">
                        <p><i><a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="blank">{{__("Learn how to get an api key")}}</a></i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Social Login")}}</h3>
        <p class="form-group-desc">{{__('Change social login information for your website')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__('Facebook')}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label> <input type="checkbox" @if($settings['facebook_enable'] ?? '' == 1) checked @endif name="facebook_enable" value="1"> {{__("Enable Facebook Login?")}}</label>
                </div>
                <div class="form-group" data-condition="facebook_enable:is(1)">
                    <label>{{__("Facebook Client Id")}}</label>
                    <div class="form-controls">
                        <input type="text" name="facebook_client_id" value="{{$settings['facebook_client_id'] ?? ''}}" class="form-control">
                    </div>
                </div>
                <div class="form-group" data-condition="facebook_enable:is(1)">
                    <label>{{__("Facebook Client Secret")}}</label>
                    <div class="form-controls">
                        <input type="text" name="facebook_client_secret" value="{{$settings['facebook_client_secret'] ?? ''}}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-title"><strong>{{__('Google')}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label><input type="checkbox" @if($settings['google_enable'] ?? '' == 1) checked @endif name="google_enable" value="1"> {{__("Enable Google Login?")}}</label>
                </div>
                <div class="form-group" data-condition="google_enable:is(1)">
                    <label>{{__("Google Client Id")}}</label>
                    <div class="form-controls">
                        <input type="text" name="google_client_id" value="{{$settings['google_client_id'] ?? ''}}" class="form-control">
                    </div>
                </div>
                <div class="form-group" data-condition="google_enable:is(1)">
                    <label>{{__("Google Client Secret")}}</label>
                    <div class="form-controls">
                        <input type="text" name="google_client_secret" value="{{$settings['google_client_secret'] ?? ''}}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-title"><strong>{{__('Twitter')}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label> <input type="checkbox" @if($settings['twitter_enable'] ?? '' == 1) checked @endif name="twitter_enable" value="1"> {{__("Enable Twitter Login?")}}</label>
                </div>
                <div class="form-group" data-condition="twitter_enable:is(1)">
                    <label>{{__("Twitter Client Id")}}</label>
                    <div class="form-controls">
                        <input type="text" name="twitter_client_id" value="{{$settings['twitter_client_id'] ?? ''}}" class="form-control">
                    </div>
                </div>
                <div class="form-group" data-condition="twitter_enable:is(1)">
                    <label>{{__("Twitter Client Secret")}}</label>
                    <div class="form-controls">
                        <input type="text" name="twitter_client_secret" value="{{$settings['twitter_client_secret'] ?? ''}}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Captcha")}}</h3>
        <p class="form-group-desc">{{__('Change map provider of your website')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("ReCaptcha Config")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="form-controls">
                        <label ><input type="checkbox" @if($settings['recaptcha_enable'] ?? '' == 1) checked @endif name="recaptcha_enable" value="1"> {{__("Enable ReCaptcha")}}</label>
                    </div>
                </div>
                <div class="form-group" data-condition="recaptcha_enable:is(1)">
                    <label>{{__("Api Key")}}</label>
                    <div class="form-controls">
                        <input type="text" name="recaptcha_api_key" value="{{$settings['recaptcha_api_key'] ?? ''}}" class="form-control">
                        <p><i><a href="http://www.google.com/recaptcha/admin" target="blank">{{__("Learn how to get an api key")}}</a></i></p>
                    </div>
                </div>
                <div class="form-group" data-condition="recaptcha_enable:is(1)">
                    <label>{{__("Api Secret")}}</label>
                    <div class="form-controls">
                        <input type="text" name="recaptcha_api_secret" value="{{$settings['recaptcha_api_secret'] ?? ''}}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Custom Scripts")}}</h3>
        <p class="form-group-desc">{{__('Add custom HTML script before and after the content, like tracking code')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("Custom Scripts")}}</strong></div>
            <div class="panel-body">
                <div class="form-group" >
                    <label>{{__("Body Script")}}</label>
                    <div class="form-controls">
                        <textarea name="body_scripts"  cols="30" rows="10" class="form-control">{{$settings['body_scripts'] ?? ''}}</textarea>
                        <p><i>{{__('scripts after open of body tag')}}</i></p>
                    </div>
                </div>
                <div class="form-group" >
                    <label>{{__("Footer Script")}}</label>
                    <div class="form-controls">
                        <textarea name="body_scripts"  cols="30" rows="10" class="form-control">{{$settings['footer_scripts'] ?? ''}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
