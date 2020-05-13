(function ($) {
window.uploaderModal = new Vue({
    el: '#cdn-browser',
    data:{
        files:[],
        viewType:'grid',
        total:0,
        totalPage:0,
        fileTypes:[],
        selected:[],
        selectedLists:[],
        showUploader:false,
        apiFinished:false,
        modalEl:false,
        multiple:false,
        filter:{},
        onSelect:function () {

        },
        uploadConfigs:{

        }
    },
    mounted(){
        let me = this;

        this.modalEl = $('#cdn-browser-modal').modal({
            show:false
        }).on('show.bs.modal',function () {
            me.reloadLists();
        });

        this.$nextTick(function () {
            $(this.$refs.files).change(function () {
                me.upload(this.files)
            })
        })

    },
    watch:{
        uploadConfigs(val){
            this.multiple = val.multiple;
            this.onSelect = val.onSelect;
        }
    },
    methods:{

        show(configs){
            this.uploadConfigs = configs;
            this.modalEl.modal('show');
        },
        hide(){
            this.modalEl.modal('hide');
        },
        changePage(p,e){
            e.preventDefault();
            this.filter.page = p;
            this.reloadLists();
        },
        selectFile(file){
            var index = this.selected.indexOf(file.id);
            if (index > -1) {
                this.selected.splice(index, 1);
                this.selectedLists.splice(index,1);
            }else{
                if(!this.multiple){
                    this.selected = [];
                    this.selectedLists = [];
                }
                this.selected.push(file.id);
                this.selectedLists.push(file);
            }
        },
        sendFiles(){

            if(typeof this.onSelect == 'function'){
                let f = this.onSelect;
                f(this.selectedLists)
            }

            this.hide();
            this.selectedLists = [];
            this.selected = [];
        },
        init(){
            var me = this;
            this.reloadLists();
        },
        reloadLists(){
            var me = this;
            this.selected = [];
            $("#cdn-browser .icon-loading").addClass("active");
            $.ajax({
                url:bookingCore.url+'/admin/module/media/getLists',
                type:'POST',
                data:{
                    file_type:this.uploadConfigs.file_type,
                    page:this.filter.page,
                    s:this.filter.s
                },
                dataType:'json',
                success:function (json) {
                    me.files = json.data;
                    me.total = json.total;
                    me.totalPage = json.totalPage;
                    me.apiFinished = true;
                    $("#cdn-browser .icon-loading").removeClass("active");
                }
            });
        },
        upload(files){
            var me = this;

            if(!files.length) return ;

            for(var i = 0; i < files.length ; i++){
                var d = new FormData();

                d.append('file',files[i]);
                d.append('type',this.uploadConfigs.file_type);
                $("#cdn-browser .icon-loading").addClass("active");
                $.ajax({
                    url:bookingCore.url+'/admin/module/media/store',
                    data:d,
                    dataType:'json',
                    type:'post',
                    contentType: false,
                    processData: false,
                    success:function (res) {
                        if(res.status)
                        {
                            me.reloadLists();
                        }
                        if(res.message){
                            alert(res.message);
                        }
                        $("#cdn-browser .icon-loading").removeClass("active");
                    },
                    error:function(e){
                        console.log(e);
                        alert('Can not upload file');
                        $("#cdn-browser .icon-loading").removeClass("active");
                    }
                })
            }

        },
        initUploader(){

        }

    }
});

Vue.component('file-item', {
        template:'#file-item-template',
        data: function () {
            return {
                count: 0
            }
        },
        props:['file',"selected","viewType"],
        methods:{
            selectFile(file){
                this.$emit('select-file',file);
            },
            fileClass(file){
                var s = [];
                s.push(file.file_type);

                if(file.file_type.substr(0,5)=='image'){
                    s.push('is-image');
                }else{
                    s.push('not-image');
                }
                return s;
            },
            getFileThumb(file){
                if(file.file_type.substr(0,5)=='image'){
                    return '<img src="'+file.thumb_size+'">';
                }
                if(file.file_type.substr(0,5)=='video'){
                    return '<img src="/assets/browser/icon/007-video-file.png">';
                }
                if(file.file_type.indexOf('x-zip-compressed')!== -1 || file.file_type.indexOf('/zip')!== -1){
                    return '<img src="/assets/browser/icon/005-zip-2.png">';
                }
                if(file.file_type.indexOf('/pdf')!== -1 ){
                    return '<img src="/assets/browser/icon/002-pdf-file-format-symbol.png">';
                }

                if(file.file_type.indexOf('/msword')!== -1 || file.file_type.indexOf('wordprocessingml')!== -1){
                    return '<img src="/assets/browser/icon/010-word.png">';
                }
                if(file.file_type.indexOf('spreadsheetml')!== -1  || file.file_type.indexOf('excel')!== -1){
                    return '<img src="/assets/browser/icon/011-excel-file.png">';
                }
                if(file.file_type.indexOf('presentation')!== -1 ){
                    return '<img src="/assets/browser/icon/powerpoint.png">';
                }
                if(file.file_type.indexOf('audio/')!== -1 ){
                    return '<img src="/assets/browser/icon/006-audio-file.png">';
                }

                return '<img src="/assets/browser/icon/008-file.png">';

            },
        }
    })
})(jQuery);