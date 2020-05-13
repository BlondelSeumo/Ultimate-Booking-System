<div id="cdn-browser-modal" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="cdn-browser" class="cdn-browser d-flex flex-column" v-cloak>
                <div class="files-nav flex-shrink-0">
                    <div class="d-flex justify-content-between">
                        <div class="col-left d-flex align-items-center">
                            <div class="filter-item">
                                <input type="text" placeholder="Search file name...." class="form-control" v-model="filter.s" @keyup.enter="filter.page = 1;reloadLists()">
                            </div>
                            <div class="filter-item">
                                <button class="btn btn-default" @click="filter.page = 1;reloadLists()">
                                    <i class="fa fa-search"></i> {{__("Search")}}</button>
                            </div>
                            <div class="filter-item">
                                <small><i>{{__("Total")}}: @{{total}} {{__("files")}}</i></small>
                            </div>
                        </div>
                        <div class="col-right">
                            <i class="fa-spin fa fa-spinner icon-loading"></i>
                            <button class="btn btn-success btn-pick-files">
                                <span><i class="fa fa-upload"></i> {{__("Upload")}}</span>
                                <input multiple type="file" name="files[]" ref="files">
                            </button>
                        </div>
                    </div>
                </div>
                <div class="upload-new" v-show="showUploader" display="none">
                    <input type="file" name="filepond[]" class="my-pond">
                </div>
                <div class="files-list">
                    <div class="files-wraps " :class="'view-'+viewType">
                        <file-item v-for="(file,index) in files" :key="index" :view-type="viewType" :selected="selected" :file="file" v-on:select-file="selectFile"></file-item>
                    </div>
                    <p class="no-files-text text-center" v-show="!total && apiFinished" style="display: none">{{__("No file found")}}</p>
                    <div class="text-center" v-if="totalPage > 1">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item" :class="{disabled:filter.page <= 1}">
                                    <a class="page-link" v-if="filter.page <=1">{{__("Previous")}}</a>
                                    <a class="page-link" href="#" v-if="filter.page > 1" v-on:click="changePage(filter.page-1,$event)">{{__("Previous")}}</a>
                                </li>
                                <li class="page-item" v-if="p >= (filter.page-3) && p <= (filter.page+3)" :class="{active: p == filter.page}" v-for="p in totalPage" @click="changePage(p,$event)">
                                    <a class="page-link" href="#">@{{p}}</a></li>
                                <li class="page-item" :class="{disabled:filter.page >= totalPage}">
                                    <a v-if="filter.page >= totalPage" class="page-link">{{__("Next")}}</a>
                                    <a href="#" class="page-link" v-if="filter.page < totalPage" v-on:click="changePage(filter.page+1,$event)">{{__("Next")}}</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="browser-actions d-flex justify-content-between flex-shrink-0" v-if="selected.length">
                    <div class="col-left" v-show="selected.length">
                        <div v-if="selected && selected.length">
                            <div class="count-selected">@{{selected.length}} {{__("file selected")}}</div>
                            <div class="clear-selected" @click="selected=[]"><i>{{__("unselect")}}</i></div>
                        </div>
                    </div>
                    <div class="col-right" v-show="selected.length">
                        <button class="btn btn-primary" :class="{disabled:!selected.length}" @click="sendFiles">{{__("Use file")}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/x-template" id="file-item-template">
    <div class="file-item" :class="fileClass(file)">
        <div class="inner" :class="{active:selected.indexOf(file.id) !== -1 }" @click="selectFile(file)" :title="file.file_name">
            <div class="file-thumb" v-if="viewType=='grid'" v-html="getFileThumb(file)">
            </div>
            <div class="file-name">@{{file.file_name}}</div>
            <span class="file-checked-status" v-show="selected.indexOf(file.id) !== -1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M186.301 339.893L96 249.461l-32 30.507L186.301 402 448 140.506 416 110z"/></svg>
            </span>
        </div>
    </div>
</script>
