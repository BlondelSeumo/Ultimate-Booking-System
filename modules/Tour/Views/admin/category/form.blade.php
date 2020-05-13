<div class="form-group">
    <label>{{__("Name")}}</label>
    <input type="text" value="{{$row->name}}" placeholder="{{__("Category name")}}" name="name" class="form-control">
</div>
<div class="form-group">
    <label>{{__("Parent")}}</label>
    <select name="parent_id" class="form-control">
        <option value="">{{__("-- Please Select --")}}</option>
        <?php
        $traverse = function ($categories, $prefix = '') use (&$traverse, $row) {
            foreach ($categories as $category) {
                if ($category->id == $row->id) {
                    continue;
                }
                $selected = '';
                if ($row->parent_id == $category->id)
                    $selected = 'selected';
                printf("<option value='%s' %s>%s</option>", $category->id, $selected, $prefix . ' ' . $category->name);
                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($parents);
        ?>
    </select>
</div>
<div class="form-group">
    <label class="control-label">{{__("Description")}}</label>
    <div class="">
        <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$row->content}}</textarea>
    </div>
</div>