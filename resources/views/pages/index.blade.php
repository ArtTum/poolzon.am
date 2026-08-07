@extends('layouts.main')

@section('content')
    @include('inc.sliders.main-slider')
    <div class="logo-list bg-middle-light hide-for-mobile" style='overflow: hidden;'>
        <div class="inner-container flex align-items--center justify--space-around">
            @foreach($brands as $brand)
                <a href="{{ \App\Http\Helpers\Helper::lang('catalog/brand/'.$brand->alias) }}" class="logo-list__item">
                    <img src="{{ '/uploads/brands/'.$brand->brand_image }}" alt="{{ $brand->brand_image }}">
                </a>
            @endforeach
        </div>
    </div>
    <div  class="categories-nav flex--wrap">
        @foreach($categories as $cat)
        <div class="categories-nav__item">
            <a href="{{ \App\Http\Helpers\Helper::lang('catalog/'.$cat->alias) }}">
                @if(in_array($cat->alias, [1712, 1701, 1705, 1703, 1704, 1710, 1711, 1712, 1706]))
                    <span class="categories-nav__icon">
                        <img width="50" src="/images/icons/{{ $cat->icon }}">
                    </span>
                @else
                    <span class="categories-nav__icon"><i class="{{ $cat->icon }}"></i></span>
                @endif
                <span>{{ \App\Http\Helpers\Translate::text($cat->lang(), 'category_name') }} </span>
            </a>
        </div>
        @endforeach
    </div>
    <div class="inner-container margin-top-large">
        <div class="row clearfix">
            <div class="col-3 page-container__left hide-for-tablet">
                @include('inc.sidebar')
            </div>
            <div class="col-9 col-md-12 page-container___right">
                @if(isset($category))
                    <h1> {{ \App\Http\Helpers\Translate::text($category->lang(), 'category_name') }}</h1>
                @endif
                @include('pages.product')
                <div class="page-count" data-max="{{ $products->lastPage() }}" id="content"></div>
                <p id="loading"><img src="/images/loading.gif"></p>
            </div>
        </div>
    </div>
@endsection
