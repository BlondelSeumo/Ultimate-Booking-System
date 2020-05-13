@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" id="booking-core-template-detail" v-cloak="">
        <div class="d-flex justify-content-between mb20">
            <div class="">
                <h1 class="title-bar">
                    @if(!empty($row->id))
                        {{__("Edit Template:")}} @{{title}}
                    @else
                        {{__('Create new template')}}
                    @endif
                </h1>
            </div>
        </div>
        <div class="alert" v-show="message.content" :class="message.type ? 'alert-success' : 'alert-danger'">@{{message.content}}</div>
        <input type="text" class="form-control" value="{{$row->title ?? ''}}" v-model="title" placeholder="{{__('Template Name')}}">
        <br>
        <br>
        <div class="row">
            <div class="col-md-4 col-xl-3 block-types-menu">
                <div class="panel">
                    <div class="panel-title">{{__('All Blocks')}}</div>
                    <div class="panel-body">
                        <div class="block-panel" v-for="block in blocks">
                            <div class="block-title">
                                @{{block.name}}
                                <div class="title-right">
                                    <span class="menu-add"><i @click="addBlock(block)" class="icon ion-ios-add-circle-outline"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-xl-9">
                <div class="panel">
                    <div class="panel-title">{{__('Template Content')}}</div>
                    <div class="panel-body">
                        <div class="templates-items-zone">
                            <draggable v-model="items">
                                <component v-on:delete="deleteBlock" :block="searchBlockById(item.type)" :is="item.component" :item="item" v-for="(item,index) in items" :key="index"></component>
                            </draggable>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <span class="alert-text" v-show="message.content" :class="message.type ? 'success' : 'danger'">@{{message.content}}</span>
                        <span class="btn btn-success" @click="saveTemplate">{{__("Save Template")}}
                            <i class="fa fa-spin fa-spinner" v-show="onSaving"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade edit-block-item-modal" id="editBlockScreen" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" v-if="block.id" id="editBlockScreenApp">
                <div class="modal-header">
                    <h5 class="modal-title">@{{block.name}}</h5>
                    <button type="button" @click="hideModal" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <vue-form-generator :schema="{fields:block.settings}" :model="model" :options="options"></vue-form-generator>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="hideModal" data-dismiss="modal">@{{template_i18n.cancel}}</button>
                    <button type="button" class="btn btn-primary" @click="saveModal">@{{template_i18n.save_changes}}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var current_template_items = {!! json_encode($row->content_json) !!};
        var current_template_title = '{{$row->title ?? ''}}';
        var template_id = {{$row->id ?? 0}};
    </script>
@endsection
@section ('script.head')
    <script>
        var template_i18n = {
            cancel: '{{__('Cancel')}}',
            save_changes: '{{__('Save changes')}}',
            delete_confirm: '{{__('Are you want to delete?')}}',
            add_new: '{{__('Add New')}}',
        };
    </script>
@endsection
