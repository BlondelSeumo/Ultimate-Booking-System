<div class="sidebar-widget widget_category">
    <div class="sidebar-title">
        <h4>{{ $item->title }}</h4>
    </div>
    @php
        $list_category = $model_category->get()->toTree();
    @endphp
    <ul>
        <?php
        $traverse = function ($categories, $prefix = '') use (&$traverse) {
            foreach ($categories as $category) {
                ?>
                    <li>
                        <span></span>
                        <a href="{{ url("/news/category/".$category->slug) }}">{{$prefix}} {{$category->name}}</a>
                    </li>
                <?php
                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($list_category);
        ?>
    </ul>
</div>