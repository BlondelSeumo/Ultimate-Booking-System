<!-- fieldAwesome.vue -->
<template>
    <div class="">
        <ckeditor :editor="editor" v-model="value" :config="config" ></ckeditor>
    </div>
</template>

<script>
    import { abstractField } from "vue-form-generator";
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import CKEditor from '@ckeditor/ckeditor5-vue';
    import BookingCoreAdaterPlugin from '../../../../admin/js/ckeditor/uploadAdapter'


    export default {
        mixins: [ abstractField ],
        data(){
            return {
                editor: ClassicEditor,
                config:{
                    extraPlugins: [ BookingCoreAdaterPlugin ],
                }
            }
        },
        components:{
            ckeditor: CKEditor.component
        }
    };
</script>