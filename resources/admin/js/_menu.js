// import {VueNestableHandle, VueNestable} from 'vue-nestable'
import {DraggableTree} from 'vue-draggable-nested-tree'
// import draggable from 'vuedraggable'
// import NestedDraggable from './components/nested-draggable.vue'

(function ($) {
    var id = $('#menu-app');
    if (!id.length) {
        return;
    }
    var menu_id = id.data('id');

    new Vue({
        el: '#menu-app',
        components: {
            // VueNestable,
            // VueNestableHandle,
            DraggableTree,
            // draggable,
            // NestedDraggable
        },
        data: {
            items: current_menu_items,
            item_types: [],
            custom_url: '',
            custom_name: "",
            name: current_menu_name,
            message: {
                type: false,
                content: ''
            },
            custom_show: false,
            locations: current_menu_locations,
            currentIndex: current_items_index + 1
        },
        mounted() {
            this.reloadTypes();
            // if(menu_id){
            //     this.reloadItems();
            // }

        },
        methods: {
            toogleItem(item) {
                if (item._open) {
                    item._open = false;
                } else {
                    item._open = true;
                }
            },
            searchItems(type) {
                // if(!type.q) return;
                $.ajax({
                    url: bookingCore.url + '/admin/module/core/menu/searchTypeItems',
                    data: {
                        class: type.class,
                        q: type.q
                    },
                    dataType: 'json',
                    type: 'post',
                    success: function (res) {
                        if (res.status) {
                            type.items = res.data;
                        }
                    },
                    error: function (e) {
                        console.log(e);
                    }
                })
            },
            reloadItems() {
                var me = this;
                $.ajax({
                    url: bookingCore.url + '/admin/module/core/menu/getItems',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        id: menu_id
                    },
                    success: function (res) {
                        if (res.data && res.status) {
                            me.items = res.data;
                        }
                    },
                    error: function (e) {
                        console.log(e);
                    }
                })
            },
            reloadTypes() {
                var me = this;
                $.ajax({
                    url: bookingCore.url + '/admin/module/core/menu/getTypes',
                    dataType: 'json',
                    type: 'post',
                    data: {},
                    success: function (res) {
                        if (res.data && res.status) {
                            me.item_types = res.data;
                        }
                    },
                    error: function (e) {
                        console.log(e);
                    }
                })
            },
            addToMenu(type) {
                if (!type.selected.length) {
                    return false;
                }

                for (var i = 0; i < type.items.length; i++) {
                    if (type.selected.indexOf(type.items[i].id) > -1) {

                        var item = Object.assign({}, type.items[i]);
                        // item._id = this.currentIndex + 1;
                        item._open = true;
                        this.items.push(item);

                        this.currentIndex += 1;

                        console.log(this.currentIndex);
                    }
                }

                type.selected = [];

            },
            addCustomUrl() {
                if (!this.custom_name) return;

                this.items.push({
                    name: this.custom_name,
                    url: this.custom_url,
                    item_model: 'custom',
                    _open: false,
                    // _id: this.items.length + 1
                });

                this.custom_name = '';
                this.custom_url = '';
            },
            parseMenuItems:function(origins){
                var items = [];

                for(var i  = 0; i < origins.length; i++){
                    var item = origins[i];
                    var tmp = Object.assign({},item);

                    delete tmp._vm;
                    delete tmp.parent;
                    delete tmp.style;
                    delete tmp.children;
                    delete tmp.style;
                    delete tmp.innerStyle;
                    delete tmp.innerBackClass;
                    delete tmp.innerBackStyle;

                    if(item.children){
                        tmp.children = this.parseMenuItems(item.children);
                    }

                    items.push(tmp);


                }
                return items;

            },
            saveMenu() {
                var me = this;

                var items = this.parseMenuItems(this.items);

                $.ajax({
                    url: bookingCore.url + '/admin/module/core/menu/store',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        id: menu_id,
                        items: JSON.stringify(items),
                        name: this.name,
                        locations: this.locations
                    },
                    success: function (res) {
                        if (res.message) {
                            me.message.content = res.message;
                            me.message.type = res.status;
                        }
                        if (res.url) {
                            window.location.href = res.url;
                        }
                    },
                    error: function (e) {
                        if (e.responseJSON.message) {
                            me.message.content = e.responseJSON.message;
                            me.message.type = false;
                        } else {

                            me.message.content = 'Can not save menu';
                            me.message.type = false;
                        }

                    }
                })
            },
            deleteMenuItem(e, item,tree) {
                e.preventDefault();
                tree.deleteNode(item);
            }
        }
    })

})(jQuery);
