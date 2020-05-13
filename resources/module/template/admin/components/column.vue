<template>
    <div class="col" :class="'col-sm-'+(item.settings.size ? item.settings.size : 12 )">
        <div class="block-panel">
            <div class="block-title">
                <span>
                    {{item.name}} -
                    <select v-model="item.settings.size">
                        <option v-for="i in 12" :value="i">{{i}}/12</option>
                    </select>
                </span>
                <div class="title-right">
                    <span class="btn btn-light block-edit dropdown">
                        <a href="#" data-toggle="dropdown" ><i class="icon ion-ios-hammer"></i></a>
                        <span class="dropdown-menu">
                            <span class="dropdown-item " @click="openEdit">Edit</span>
                            <span class="dropdown-item ">Delete</span>
                        </span>
                    </span>
                    <span class="block-toggle btn btn-light"><i @click="item.open =  item.open ? false: true" class="icon ion-md-arrow-dropdown"></i></span>
                </div>
            </div>
            <div class="block-content" v-show="item.open">
                <component :is="child.component" :item="child" v-for="(child,index) in item.children" :key="index"></component>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{

            }
        },
        props:{
            item:{}
        },
        methods:{
            openEdit(){

            }
        }
    }
</script>