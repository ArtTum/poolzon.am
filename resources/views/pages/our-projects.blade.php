@extends('layouts.main')
@section('title')
    {{ 'Наши проекты' }}
@stop
@section('meta_desc', 'Наши проекты')
@section('meta_keywords', 'Наши проекты')
@section('content')
    @include('inc.sliders.main-slider')
    <div class="logo-list bg-middle-light hide-for-mobile" style="overflow: hidden">
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
                <h1 class="our-title">  {{ \App\Http\Helpers\Translate::text($category->lang(), 'category_name') }}</h1>

                <div class="row">
                    @foreach($ourProjects as $k => $ourProject)
                        <div class="col-4 col-xs-6 {{ ($k == 0) ? 'active' : '' }}">
                            <div class="panel">
                                <div class="panel-thumbnail">
                                    <a href="/uploads/our-projects/{{ $ourProject->image }}" class="js-smartPhoto" data-caption="{{ \App\Http\Helpers\Translate::text($ourProject->lang(), 'our_project_name') }}" data-id="{{ \App\Http\Helpers\Translate::text($ourProject->lang(), 'our_project_name') }}" data-group="animal">
                                        <img style="display:none;" src="/uploads/our-projects/{{ $ourProject->image }}" />
                                        <div class="potoImg" style='background-image: url("/uploads/our-projects/{{ $ourProject->image }}");'></div>
                                    </a>
                                </div>
                                <p class="product-item__title">
                                    <span class="font-primary--medium display--block">
                                       {{ \App\Http\Helpers\Translate::text($ourProject->lang(), 'our_project_name') }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded',function(){
            new SmartPhoto(".js-smartPhoto");
        });
    </script>
    <style>
        .our-title {
            margin-bottom: 15px;
        }
        .panel{
            padding: 0px 0px;
        }
        .panel .product-item__title {
            margin-top: 10px;
            min-height: 60px;
        }
        .potoImg{
            width: 100%;
            height: 215px;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endsection
