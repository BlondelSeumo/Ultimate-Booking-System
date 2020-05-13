<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("General Style")}}</h3>
        <p class="form-group-desc">{{__('Change main color, typo ...')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__('General Options')}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label>{{__("Main color")}}</label>
                    <div class="form-controls">
                        <input type="text" name="style_main_color" value="{{$settings['style_main_color'] ?? '#5191FA'}}" class="has-colorpicker d-none">
                    </div>
                </div>
                <div class="form-group">
                    <label><strong>{{__("Typography")}}</strong></label>
                    <div class="form-controls">
                        @php $typo = json_decode(setting_item('style_typo',"{}"),true) @endphp
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__("Font Family")}}</label>
                                    <input type="text" name="style_typo[font_family]" class="form-control"  value="{{$typo['font_family'] ?? ''}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__("Color")}}</label>
                                    <div class="form-controls">
                                        <input type="text" name="style_typo[color]" class="has-colorpicker"  value="{{$typo['color'] ?? ''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__("Font Size")}}</label>
                                    <input type="number" name="style_typo[font_size]" class="form-control" min="0" max="60" value="{{$typo['font_size'] ?? ''}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__("Line Height")}}</label>
                                    <input type="number" name="style_typo[line_height]" class="form-control" min="0" max="60" value="{{$typo['line_height'] ?? ''}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__("Font Weight")}}</label>
                                    <input type="text" placeholder="{{__('bold or 400')}}" name="style_typo[font_weight]" class="form-control"  value="{{$typo['font_weight'] ?? ''}}">
                                </div>
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
        <h3 class="form-group-title">{{__("Custom CSS")}}</h3>
        <p class="form-group-desc">{{__('Write your own custom css code')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__('Custom CSS')}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label>{{__("Custom CSS")}}</label>
                    <div class="form-controls">
                        <div id="custom_css_editor" class="ace-editor" style="height: 400px" data-theme="monokai" data-mod="css">{{$settings['style_custom_css'] ?? ''}}</div>
                        <textarea class=" d-none" name="style_custom_css" >{{$settings['style_custom_css'] ?? ''}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script.body')
    <script src="{{asset('libs/ace/src-min-noconflict/ace.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('libs/spectrum/spectrum.js')}}" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="{{asset('libs/spectrum/spectrum.css')}}">
    <script>
        (function ($) {
            $('.ace-editor').each(function () {

                var editor = ace.edit($(this).attr('id'));
                editor.setTheme("ace/theme/"+$(this).data('theme'));
                editor.session.setMode("ace/mode/"+$(this).data('mod'));
                var me = $(this);

                editor.session.on('change', function(delta) {
                    // delta.start, delta.end, delta.lines, delta.action
                    me.next('textarea').val(editor.getValue());
                });
            });

            $('.has-colorpicker').spectrum({
                togglePaletteMoreText: 'more',
                togglePaletteLessText: 'less',
                showAlpha: true,
                showPalette: true,
                palette: [
                    ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
                    ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
                    ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
                    ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
                    ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
                    ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
                    ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
                    ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
                ],
                showInput: true,
                allowEmpty:true,
                showInitial: true,
                preferredFormat: "hex",
            });
        })(jQuery)
    </script>
@endsection