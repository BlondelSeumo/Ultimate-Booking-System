<template>
    <div class="block-panel">
        <div class="block-title">
            {{item.name}}
            <div class="title-right">
                <span class="btn btn-light block-delete show-hover"><i class="icon ion-ios-trash"></i></span>
                <span class="block-edit btn btn-light show-hover"><i class="icon ion-ios-build"></i></span>
                <span class="block-toggle btn btn-light"><i @click="item.open =  item.open ? false: true" class="icon ion-md-arrow-dropdown"></i></span>
            </div>
        </div>
        <div class="block-content" v-show="item.open">
            <div class="row">
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
        }
    }
</script>