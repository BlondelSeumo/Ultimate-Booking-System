<div class="form-group">
    <label>{{__("Locale")}}</label>
    <div>
        <select name="locale" class="form-control dungdt-select2-field dungdt_input_locale" data-options='{"allowClear":true}' data-id="{{$row->id}}">
            <option value="">{{__("-- Please select --")}}</option>
            @foreach($locales as $locale => $name)
                <option data-name="{{$name}}" @if($row->locale == $locale) selected @endif value="{{$locale}}">{{$name}} - ({{$locale}})</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <label>{{__("Flag Icon")}}</label>
    <div class="input-group mb-3">
        <input type="text" value="{{$row->flag}}" placeholder="{{__("Eg: gb")}}" name="flag" class="form-control dungdt-input-flag-icon" required>
        <div class="input-group-append">
            <span class="input-group-text"><span class="flag-icon  flag-icon-{{$row->flag}}"></span></span>
        </div>

        <div class="invalid-feedback">
            {{__('Please input flag code')}}
        </div>
    </div>
</div>
<div class="form-group">
    <label>{{__("Name")}}</label>
    <input type="text" value="{{$row->name}}" placeholder="{{__("Display Name")}}" name="name" class="form-control" required>
    <div class="invalid-feedback">
        {{__('Please input language name')}}
    </div>
</div>
<div class="form-group">
    <label>{{__("Status")}}</label>
    <div class="">
        <label>
            <input type="radio" @if(!$row->status or $row->status == 'publish') checked @endif name="status" value="publish"> {{__('Publish')}}
        </label>
    </div>
    <div>
        <label>
            <input type="radio" @if($row->status == 'draft') checked @endif name="status" value="draft"> {{__('Draft')}}
        </label>
    </div>
</div>
