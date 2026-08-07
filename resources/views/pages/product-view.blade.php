@extends('layouts.main')

@section('content')
    <div class="top-bg margin-bottom-large" style="background-image: url('/images/top-bg.png')">
        <div class="inner-container">
            <ul class="path-list inline-elements">
                <li class="path-list__item">
                    <a class="link link--primary" href="{{ \App\Http\Helpers\Helper::lang() }}">
                        {{ __('messages.Home') }}
                    </a>
                </li>
                <li class="path-list__item"><a class="link link--primary"
                                               href="">{{ \App\Http\Helpers\Translate::text($product->lang(), 'product_name') }}</a>
                </li>
            </ul>

            <div class="top-bg__content">
                <h1 class="title--primary font-large-xs font-primary--medium margin-top-medium">
                    {{ \App\Http\Helpers\Translate::text($product->lang(), 'product_name') }}
                </h1>
            </div>
        </div>
    </div>

    <div class="product-container">
        <div class="inner-container">
            <div class="row row-flex flex flex--wrap margin-bottom-large">
                <div class="col-5 col-lg-4 col-sm-6 col-xs-12">
                    <div class="product-container__slider bg-contain"
                         style="background-image: url({{ '/uploads/products/'.$product->product_image }})"></div>
                </div>
                <div class="col-7 col-lg-8 col-sm-6 col-xs-12">
                    <div class="product-container__info info-box">
                        <div class="info-box__top flex align-items--center justify--space-between">
                            <div>
                                <button onclick="addFavorite( {{ $product->id }} )" class="def-button def-button--secondary def-button--icon-left">
                                    <span class="def-button__icon  {{ 'f-'.$product->id }} {{ in_array($product->id, $favorites ?? []) ? 'active' : '' }}">
                                        <i class="icon-favorite"></i>
                                    </span>
                                    <span class="def-button__text">{{ __('messages.В избранное') }}
                                </span>
                                </button>
                            </div>
                            <div>
                                @include('inc.social')
                            </div>
                        </div>
                        <div class="info-box__content">
                            <div class="row row-flex flex flex--wrap">
                                <div class="col-7 col-md-6 col-sm-12">
                                    <ul class="info-list">
                                        @if(!empty($product->brand))
                                            <li class="info-list__item flex justify--space-between align-items--center">
                                                <span class="info-list__label">{{ __('messages.Бренд') }}</span>
                                                <span class="info-list__value">
                                                {{ \App\Http\Helpers\Translate::text($product->brand->lang(), 'brand_name') }}
                                            </span>
                                            </li>
                                        @endif
                                        @if(!empty($product->colorshas))
                                        <li class="info-list__item flex justify--space-between align-items--center">
                                            <span class="info-list__label">{{ __('messages.Цвет') }}</span>
                                            <span class="info-list__value">
                                                @foreach($product->colorshas as $k => $color)
                                                    @if($k != 0)
                                                        ,
                                                    @endif
                                                    {{ \App\Http\Helpers\Translate::text($color->lang(), 'color_name') }}
                                                @endforeach
                                        </span>
                                        </li>
                                        @endif
                                        @if(!empty($product->type))
                                        <li class="info-list__item flex justify--space-between align-items--center">
                                            <span class="info-list__label">{{ __('messages.Тип') }}</span>
                                            <span class="info-list__value">
                                                {{ \App\Http\Helpers\Translate::text($product->type->lang(), 'type_name') }}
                                            </span>
                                        </li>
                                        @endif
                                        @if(!empty($product->appointment))
                                        <li class="info-list__item flex justify--space-between align-items--center">
                                            <span
                                                class="info-list__label">{{ __('messages.Назначение прибора') }}</span>
                                            <span class="info-list__value">
                                                {{ \App\Http\Helpers\Translate::text($product->appointment->lang(), 'appointment_name') }}
                                            </span>
                                        </li>
                                        @endif
                                        @if($product->number_mounting_holes)
                                        <li class="info-list__item flex justify--space-between align-items--center">
                                            <span
                                                class="info-list__label">{{ __('messages.Число монтажных отверстий') }}</span>
                                            <span class="info-list__value">
                                            {{ $product->number_mounting_holes }}
                                        </span>
                                        </li>
                                        @endif
                                        <li class="info-list__item flex justify--space-between align-items--center">
                                            <span class="info-list__label">{{ __('messages.Код товара') }}</span>
                                            <span class="info-list__value">
                                            {{ $product->product_code }}
                                        </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-5 col-md-6 col-sm-12">
                                    <div class="info-box__cart">
                                        <div class="margin-bottom-medium-lg price price--lg">
                                            @if($product->sale)
                                                <span class="price__actual no-wrap color-pink">{{ number_format($product->price - ($product->price * $product->sale / 100)) }}<span
                                                        class="price__icon"><i class="icon-dram"></i></span></span>
                                                <span class="price__discount no-wrap">{{ number_format($product->price) }}<span class="price__icon"><i
                                                            class="icon-dram"></i></span>
                                        </span>
                                            @else
                                                <span class="price__actual no-wrap">{{ number_format($product->price) }}<span
                                                        class="price__icon"><i class="icon-dram"></i></span></span>

                                            @endif
                                        </div>
                                        <form class="add-cart" action="/add" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $product->id }}" name="id">
                                            <input type="hidden" value="{{ \App\Http\Helpers\Translate::text($product->lang(), 'product_name') }}" name="name">
                                            <input type="hidden" value="{{ $product->sale ? ($product->price - ($product->price * $product->sale / 100)) : $product->price}}" name="price">
                                            <input type="hidden" value="{{ '/uploads/products/'.$product->product_image }}"  name="img">
                                            <input type="hidden" value="1"  name="quantity">
                                            <button {{ $product->product_count == 0 ? 'disabled=disabled' : false}}
                                                class="def-button def-button--primary def-button--icon-left width-percent-full {{ $product->product_count == 0 ? 'disabled' : false}}">
                                                <span class="def-button__icon"><i class="icon-cart"></i></span>
                                                <span class="def-button__text">{{ $product->product_count == 0 ? __('messages.disabled') : __('messages.Добавить в корзину')}}</span>
                                            </button>
                                        </form>

                                        <div class="margin-top-medium-lg">
                                            <p class="info-box__subtitle margin-bottom-small">{{ __('messages.Доставка') }}</p>
                                            <p class="info-box__text font-small color-tertiary">
                                                {{ __('messages.Доставка в Ереване 1000 др. / за пределом Еревана + 150 др. за километр') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="inner-container margin-top-large margin-bottom-large">
            <h3 class="font-medium font-primary--bold margin-bottom-large">{{ __('messages.Рекомендуем также') }}</h3>
            <div class="slider simple-carousel relative">
                @foreach($categoryProducts as $categoryProduct)
                    <div class="product-item" style="padding-right: 15px;}">
                        <div class="product-item__img bg-contain" style="background-image: url({{ '/uploads/products/'.$categoryProduct->product_image }});">
                            <a href="{{ \App\Http\Helpers\Helper::lang('product/'.$categoryProduct->alias) }}"></a>
                            <span class="product-item__icon favorite {{ 'f-'.$categoryProduct->id }} {{ in_array($categoryProduct->id, $favorites ?? []) ? 'active' : '' }}"  onclick="addFavorite( {{ $categoryProduct->id }} )">
                                <i class="icon-favorite"></i>
                            </span>
                        </div>
                        <div class="product-item__info">
                            @if($categoryProduct->sale)
                                <span class="discount margin-bottom-small">-{{ $categoryProduct->sale }}%</span>
                            @endif
                            <div class="product-item__price price margin-bottom-small">
                                @if($categoryProduct->sale)
                                    <span class="price__actual no-wrap color-pink">{{ number_format($categoryProduct->price - ($categoryProduct->price * $categoryProduct->sale / 100)) }}<span
                                            class="price__icon"><i class="icon-dram"></i></span></span>
                                    <span class="price__discount no-wrap">{{ number_format($categoryProduct->price) }}<span class="price__icon"><i
                                                class="icon-dram"></i></span>
                                        </span>
                                @else
                                    <span class="price__actual no-wrap">{{ number_format($categoryProduct->price) }}<span
                                            class="price__icon"><i class="icon-dram"></i></span></span>

                                @endif
                            </div>
                            <p class="product-item__type font-primary--medium margin-bottom-small-xs">
                                @if($categoryProduct->bestseller == 1)
                                    {{ __('messages.Бестселлер') }}
                                @endif
                            </p>
                            <p class="product-item__title">
                                <a href="{{ \App\Http\Helpers\Helper::lang('product/'.$categoryProduct->alias) }}">
                                <span class="font-primary--medium display--block">
                                    {{ \App\Http\Helpers\Translate::text($categoryProduct->lang(), 'product_name') }}
                                </span>
                                </a>
                            </p>
                            <div class="product-item__button">
                                <form class="add-cart" action="/add" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $categoryProduct->id }}" name="id">
                                    <input type="hidden" value="{{ \App\Http\Helpers\Translate::text($categoryProduct->lang(), 'product_name') }}" name="name">
                                    <input type="hidden" value="{{ $categoryProduct->sale ? ($categoryProduct->price - ($categoryProduct->price * $product->sale / 100)) : $categoryProduct->price}}" name="price">
                                    <input type="hidden" value="{{ '/uploads/products/'.$categoryProduct->product_image }}"  name="img">
                                    <input type="hidden" value="category"  name="slug">
                                    <input type="hidden" value="1"  name="quantity">
                                    <button {{ $categoryProduct->product_count == 0 ? 'disabled=disabled' : false}} type="submit" class="def-button def-button--primary def-button--icon-left {{ $categoryProduct->product_count == 0 ? 'disabled' : false}}">
                                        <span class="def-button__icon"><i class="icon-cart"></i></span>
                                        <span class="def-button__text">{{ $categoryProduct->product_count == 0 ? __('messages.disabled') : __('messages.В корзину')}}</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <div class="product-container__description bg-light">
            <div class="inner-container">
                <div class="row row-flex flex flex--wrap">
                    <div class="col-6 col-sm-12">
                        @if(trim(\App\Http\Helpers\Translate::text($product->lang(), 'advantages')))
                        <div class="margin-bottom-large">
                            <h3 class="font-medium font-primary--bold margin-bottom-medium-lg">{{ __('messages.Описание') }}</h3>
                            <div class="text-box">
                                <p>
                                    {{ \App\Http\Helpers\Translate::text($product->lang(), 'advantages') }}
                                </p>
                            </div>
                        </div>
                        @endif
                        @if(trim(\App\Http\Helpers\Translate::text($product->lang(), 'description')))
                        <div class="margin-bottom-large">
                            <h3 class="font-medium font-primary--bold margin-bottom-medium-lg">{{ __('messages.Преимущества') }}</h3>
                            <div class="text-box">
                                <p>
                                    {{ \App\Http\Helpers\Translate::text($product->lang(), 'description') }}
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-6 col-sm-12">
                        <h3 class="font-medium font-primary--bold margin-bottom-medium-lg">{{ __('messages.Характеристики') }}</h3>
                        <ul class="info-list">
                            @if(!empty($product->brand))
                                <li class="info-list__item flex justify--space-between align-items--center">
                                    <span class="info-list__label">{{ __('messages.Бренд') }}</span>
                                    <span class="info-list__value">
                                                {{ \App\Http\Helpers\Translate::text($product->brand->lang(), 'brand_name') }}
                                            </span>
                                </li>
                            @endif
                            @if(!empty($product->colorshas))
                            <li class="info-list__item flex justify--space-between align-items--center">
                                <span class="info-list__label">{{ __('messages.Цвет') }}</span>
                                <span class="info-list__value">
                                    @foreach($product->colorshas as $k => $color)
                                        @if($k != 0)
                                            ,
                                        @endif
                                        {{ \App\Http\Helpers\Translate::text($color->lang(), 'color_name') }}
                                    @endforeach
                                </span>
                            </li>
                            @endif
                            @if(!empty($product->type))
                            <li class="info-list__item flex justify--space-between align-items--center">
                                <span class="info-list__label">{{ __('messages.Тип') }}</span>
                                <span class="info-list__value">
                                    {{ \App\Http\Helpers\Translate::text($product->type->lang(), 'type_name') }}
                                </span>
                            </li>
                            @endif
                            @if(!empty($product->appointment))
                            <li class="info-list__item flex justify--space-between align-items--center">
                                <span class="info-list__label">{{ __('messages.Назначение прибора') }}</span>
                                <span class="info-list__value">
                                    {{ \App\Http\Helpers\Translate::text($product->appointment->lang(), 'appointment_name') }}
                                </span>
                            </li>
                            @endif
                            @if($product->number_mounting_holes)
                            <li class="info-list__item flex justify--space-between align-items--center">
                                <span class="info-list__label">{{ __('messages.Число монтажных отверстий') }}</span>
                                <span class="info-list__value">{{ $product->number_mounting_holes }}</span>
                            </li>
                            @endif
                            <li class="info-list__item flex justify--space-between align-items--center">
                                <span class="info-list__label">{{ __('messages.Код товара') }}</span>
                                <span class="info-list__value">{{ $product->product_code }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @if($bestsellers->count() > 0)
        <div class="inner-container margin-top-large margin-bottom-large">
            <h3 class="font-medium font-primary--bold margin-bottom-large">{{ __('messages.Возможно, вам понравится') }}</h3>
            <div class="slider simple-carousel relative">
                @foreach($bestsellers as $bestseller)
                <div class="product-item" style="padding-right: 15px;}">
                    <div class="product-item__img bg-contain" style="background-image: url({{ '/uploads/products/'.$bestseller->product_image }});">
                        <a href="{{ \App\Http\Helpers\Helper::lang('product/'.$bestseller->alias) }}"></a>
                        <span class="product-item__icon favorite {{ 'f-'.$bestseller->id }} {{ in_array($bestseller->id, $favorites ?? []) ? 'active' : '' }}"  onclick="addFavorite( {{ $bestseller->id }} )">
                            <i class="icon-favorite"></i>
                        </span>
                    </div>
                    <div class="product-item__info">
                        @if($bestseller->sale)
                            <span class="discount margin-bottom-small">-{{ $bestseller->sale }}%</span>
                        @endif
                        <div class="product-item__price price margin-bottom-small">
                            @if($bestseller->sale)
                                <span class="price__actual no-wrap color-pink">{{ number_format($bestseller->price - ($bestseller->price * $bestseller->sale / 100)) }}<span
                                        class="price__icon"><i class="icon-dram"></i></span></span>
                                <span class="price__discount no-wrap">{{ number_format($bestseller->price) }}<span class="price__icon"><i
                                            class="icon-dram"></i></span>
                                        </span>
                            @else
                                <span class="price__actual no-wrap">{{ number_format($bestseller->price) }}<span
                                        class="price__icon"><i class="icon-dram"></i></span></span>

                            @endif
                        </div>
                        <p class="product-item__type font-primary--medium margin-bottom-small-xs">
                            @if($bestseller->bestseller == 1)
                                {{ __('messages.Бестселлер') }}
                            @endif
                        </p>
                        <p class="product-item__title">
                            <a href="{{ \App\Http\Helpers\Helper::lang('product/'.$bestseller->alias) }}">
                                <span class="font-primary--medium display--block">
                                    {{ \App\Http\Helpers\Translate::text($bestseller->lang(), 'product_name') }}
                                </span>
                            </a>
                        </p>
                            <div class="product-item__button">

                                <form class="add-cart" action="/add" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $bestseller->id }}" name="id">
                                    <input type="hidden" value="{{ \App\Http\Helpers\Translate::text($bestseller->lang(), 'product_name') }}" name="name">
                                    <input type="hidden" value="{{ $bestseller->sale ? ($bestseller->price - ($bestseller->price * $product->sale / 100)) : $bestseller->price}}" name="price">
                                    <input type="hidden" value="{{ '/uploads/products/'.$bestseller->product_image }}"  name="img">
                                    <input type="hidden" value="category"  name="slug">
                                    <input type="hidden" value="1"  name="quantity">
                                    <button {{ $bestseller->product_count == 0 ? 'disabled=disabled' : false}} type="submit" class="def-button def-button--primary def-button--icon-left {{ $bestseller->product_count == 0 ? 'disabled' : false}}">
                                        <span class="def-button__icon"><i class="icon-cart"></i></span>
                                        <span class="def-button__text">{{ $bestseller->product_count == 0 ? __('messages.disabled') : __('messages.В корзину')}}</span>
                                    </button>
                                </form>
                            </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        @endif
    </div>

@endsection
