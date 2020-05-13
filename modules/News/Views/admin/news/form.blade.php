<div class="form-group">
    <label>{{ __('Title')}}</label>
    <input type="text" value="{{ $row->title ?? 'New Post' }}" placeholder="News title" name="title" class="form-control">
</div>
<div class="form-group">
    <label>{{  __('Category')}} </label>
    <select name="cat_id" class="form-control">
        <option value="">{{ __('-- Please Select --')}} </option>
        <?php
        $traverse = function ($categories, $prefix = '') use (&$traverse, $row) {
            foreach ($categories as $category) {
                $selected = '';
                if ($row->cat_id == $category->id)
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
    <label class="control-label">{{ __('Content')}} </label>
    <div class="">
        <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$row->content}}</textarea>
    </div>
</div>
 