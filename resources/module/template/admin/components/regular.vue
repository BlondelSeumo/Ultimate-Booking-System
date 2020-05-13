 <template>
    <div class="block-panel">
        <div class="block-title">
            {{item.name}}
            <div class="title-right">
                <span class="btn btn-light block-delete show-hover" @click="deleteBlock"><i class="icon ion-ios-trash"></i></span>
                <span class="btn btn-light block-edit" @click="openEdit"><i  class="icon ion-ios-build"></i></span>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                i18n:template_i18n
            }
        },
        props:{
            item:{},
            block:{}
        },
        methods:{
            openEdit(){
                editBlockScreen.openEdit(this.item,this.block);

            },
            deleteBlock(){
                let c = confirm(this.i18n.delete_confirm);

                if(!c) return;

                this.$emit('delete',this.key);
            }
        }
    }
</script>