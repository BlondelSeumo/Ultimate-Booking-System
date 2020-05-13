<div class="user-form-settings">
    <div class="breadcrumb-page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{url("/user/dashboard")}}">
                    {{__("Home")}}
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>&nbsp; {{__("Setting")}} </li>
        </ul>
        <div class="bravo-more-menu-user">
            <i class="icofont-settings"></i>
        </div>
    </div>
    <h2 class="title-bar">
        {{__("Settings")}}
        <a href="{{url("/user/profile/change-password")}}" class="btn-change-password">{{__("Change Password")}}</a>
    </h2>
    @include('admin.message')
    <form action="{{url("/user/profile")}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-title">
                    <strong>{{__("Personal Information")}}</strong>
                </div>
                <div class="form-group">
                    <label>{{__("E-mail")}}</label>
                    <input type="text" value="{{$dataUser->email}}" placeholder="{{__("E-mail")}}" readonly class="form-control">
                    <i class="fa fa-envelope input-icon"></i>
                </div>
                <div class="form-group">
                    <label>{{__("First name")}}</label>
                    <input type="text" value="{{$dataUser->first_name}}" name="first_name" placeholder="{{__("First name")}}" class="form-control">
                    <i class="fa fa-user input-icon"></i>
                </div>
                <div class="form-group">
                    <label>{{__("Last name")}}</label>
                    <input type="text" value="{{$dataUser->last_name}}" name="last_name" placeholder="{{__("Last name")}}" class="form-control">
                    <i class="fa fa-user input-icon"></i>
                </div>
                <div class="form-group">
                    <label>{{__("Phone Number")}}</label>
                    <input type="text" value="{{$dataUser->phone}}" name="phone" placeholder="{{__("Phone Number")}}" class="form-control">
                    <i class="fa fa-phone input-icon"></i>
                </div>
                <div class="form-group">
                    <label>{{__("Birthday")}}</label>
                    <input type="text" value="{{ $dataUser->birthday? display_date($dataUser->birthday) :'' }}" name="birthday" placeholder="{{__("Birthday")}}" class="form-control date-picker">
                    <i class="fa fa-birthday-cake input-icon"></i>
                </div>
                <div class="form-group">
                    <label>{{__("About Yourself")}}</label>
                    <textarea name="bio" rows="5" class="form-control">{{$dataUser->bio}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{__("Avatar")}}</label>
                    <div class="upload-btn-wrapper">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    {{__("Browse")}}… <input type="file">
                                </span>
                            </span>
                            <input type="text" data-error="{{__("Error upload...")}}" data-loading="{{__("Loading...")}}" class="form-control text-view" readonly value="{{ $dataUser->getAvatarUrl()?? __("No Image")}}">
                        </div>
                        <input type="hidden" class="form-control" name="avatar_id" value="{{ $dataUser->avatar_id?? ""}}">
                        <img class="image-demo" src="{{ $dataUser->getAvatarUrl()?? ""}}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-title">
                    <strong>{{__("Location Information")}}</strong>
                </div>
                <div class="form-group">
                    <label>{{__("Address")}}</label>
                    <input type="text" value="{{$dataUser->address}}" name="address" placeholder="{{__("Address")}}" class="form-control">
                    <i class="fa fa-location-arrow input-icon"></i>
                </div>
                <div class="form-group">
                    <label>{{__("Address2")}}</label>
                    <input type="text" value="{{$dataUser->address2}}" name="address2" placeholder="{{__("Address2")}}" class="form-control">
                    <i class="fa fa-location-arrow input-icon"></i>
                </div>
                <div class="form-group">
                    <label>{{__("City")}}</label>
                    <input type="text" value="{{$dataUser->city}}" name="city" placeholder="{{__("City")}}" class="form-control">
                    <i class="fa fa-street-view input-icon"></i>
                </div>
                <div class="form-group">
                    <label>{{__("State")}}</label>
                    <input type="text" value="{{$dataUser->state}}" name="state" placeholder="{{__("State")}}" class="form-control">
                    <i class="fa fa-map-signs input-icon"></i>
                </div>
                <div class="form-group">
                    <label>{{__("Country")}}</label>
                    <select name="country" class="form-control">
                        <option value="">{{__('-- Select --')}}</option>
                        @foreach(get_country_lists() as $id=>$name)
                            <option @if(($dataUser->country ?? '') == $id) selected @endif value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{__("Zip Code")}}</label>
                    <input type="text" value="{{$dataUser->zip_code}}" name="zip_code" placeholder="{{__("Zip Code")}}" class="form-control">
                    <i class="fa fa-map-pin input-icon"></i>
                </div>
            </div>
            <div class="col-md-12">
                <hr>
                <input type="submit" class="btn btn-primary" value="Save Changes">
            </div>
        </div>
    </form>
</div>