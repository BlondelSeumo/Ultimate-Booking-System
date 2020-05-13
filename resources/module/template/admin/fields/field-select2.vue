<template>
    <select>
    </select>
</template>
<script>

    import { abstractField } from "vue-form-generator";

    export default {
        mixins: [ abstractField ],
        data(){
            return {
                options:[],
                selectedText:''
            }
        },
        mounted: function () {
            var vm = this;

            $(vm.$el).select2(vm.schema.select2);

            if(this.schema.pre_selected && this.value){
                $.ajax({
                    method:'get',
                    url:this.schema.pre_selected,
                    data:{
                        selected:this.value
                    },
                    dataType:'json',
                    success:function (json) {
                        //vm.selectedText = json.text;
                        var newOption = new Option(json.text, vm.value, false, false);

                        $(vm.$el).append(newOption).trigger('change');

                    }

                })
            }else{

            }
        },
        watch: {
            // value: function (value) {
            //     // update value
            //     $(this.$el)
            //         .val(value)
            //         .trigger('change')
            // },
            options: function (options) {
                // update options
                //$(this.$el).empty().select2({ data: options })
            }
        },
        destroyed: function () {
            $(this.$el).off().select2('destroy')
        }
    };
</script>
