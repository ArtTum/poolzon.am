<?php
$categories = \App\Models\Category::where('category_status', 1)->orderBy('order_number')->get();
$alias = $alias ?? '';
?>
<ul class="list  margin-bottom-large-xs">
    @foreach($categories as $category)
        <li class="list__item {{ $alias == $category->alias ? 'active' : '' }}">
            <a href="{{ \App\Http\Helpers\Helper::lang('catalog/'.$category->alias) }}">
                {{ \App\Http\Helpers\Translate::text($category->lang(), 'category_name') }}
            </a>
        </li>
    @endforeach
</ul>
