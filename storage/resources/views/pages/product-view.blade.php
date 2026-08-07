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
                                <button class="def-button def-button--secondary def-button--icon-left">
                                    <span class="def-button__icon"><i class="icon-favorite"></i></span>
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
                                        <li class="info-list__item flex justify--space-between align-items--center">
                                            <span class="info-list__label">{{ __('messages.Цвет') }}</span>
                                            <span class="info-list__value">
                                            @foreach($product->colorshas as $color)
                                                    {{ \App\Http\Helpers\Translate::text($color->lang(), 'color_name') }}
                                                    ,
                                                @endforeach
                                        </span>
                                        </li>
                                        <li class="info-list__item flex justify--space-between align-items--center">
                                            <span class="info-list__label">{{ __('messages.Тип') }}</span>
                                            <span class="info-list__value">
                                                {{ \App\Http\Helpers\Translate::text($product->type->lang(), 'type_name') }}
                                            </span>
                                        </li>
                                        <li class="info-list__item flex justify--space-between align-items--center">
                                            <span
                                                class="info-list__label">{{ __('messages.Назначение прибора') }}</span>
                                            <span class="info-list__value">
                                                {{ \App\Http\Helpers\Translate::text($product->appointment->lang(), 'appointment_name') }}
                                            </span>
                                        </li>
                                        <li class="info-list__item flex justify--space-between align-items--center">
                                            <span
                                                class="info-list__label">{{ __('messages.Число монтажных отверстий') }}</span>
                                            <span class="info-list__value">
                                            {{ $product->number_mounting_holes }}
                                        </span>
                                        </li>
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
                                        <span class="price__actual no-wrap">
                                            {{ $product->price }}
                                            <span class="price__icon"><i class="icon-dram"></i></span>
                                        </span>
                                            {{--                                        <span class="price__discount no-wrap">16 266<span class="price__icon"><i class="icon-dram"></i></span></span>--}}
                                        </div>
                                        <button
                                            class="def-button def-button--primary def-button--icon-left width-percent-full">
                                            <span class="def-button__icon"><i class="icon-cart"></i></span>
                                            <span class="def-button__text">Добавить в корзину</span>
                                        </button>
                                        <div class="margin-top-medium-lg">
                                            <p class="info-box__subtitle margin-bottom-small">Доставка</p>
                                            <p><span class="margin-right-small color-tertiary">В Ереван</span><a href=""
                                                                                                                 class="link link--primary font-small">Изменить</a>
                                            </p>
                                            <p class="info-box__text font-small color-tertiary">Доставка в Ереване 1000
                                                др. / за пределом Еревана + 150 др. за километр</p>
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
            @include('inc.carousels.carousel')
        </div>

        <div class="product-container__description bg-light">
            <div class="inner-container">
                <div class="row row-flex flex flex--wrap">
                    <div class="col-6 col-sm-12">
                        <div class="margin-bottom-large">
                            <h3 class="font-medium font-primary--bold margin-bottom-medium-lg">{{ __('messages.Описание') }}</h3>
                            <div class="text-box">
                                <p>
                                    {{ \App\Http\Helpers\Translate::text($product->lang(), 'description') }}
                                </p>
                            </div>
                        </div>
                        <div class="margin-bottom-large">
                            <h3 class="font-medium font-primary--bold margin-bottom-medium-lg">{{ __('messages.Преимущества') }}</h3>
                            <div class="text-box">
                                <p>
                                    {{ \App\Http\Helpers\Translate::text($product->lang(), 'advantages') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-12">
                        <h3 class="font-medium font-primary--bold margin-bottom-medium-lg">{{ __('messages.Характеристики') }}</h3>
                        <ul class="info-list">
                            <li class="info-list__item flex justify--space-between align-items--center">
                                <span class="info-list__label">{{ __('messages.Цвет') }}</span>
                                <span class="info-list__value">
                                   @foreach($product->colorshas as $color)
                                        {{ \App\Http\Helpers\Translate::text($color->lang(), 'color_name') }},
                                    @endforeach
                                </span>
                            </li>
                            <li class="info-list__item flex justify--space-between align-items--center">
                                <span class="info-list__label">{{ __('messages.Тип') }}</span>
                                <span class="info-list__value">
                                    {{ \App\Http\Helpers\Translate::text($product->type->lang(), 'type_name') }}
                                </span>
                            </li>
                            <li class="info-list__item flex justify--space-between align-items--center">
                                <span class="info-list__label">{{ __('messages.Назначение прибора') }}</span>
                                <span class="info-list__value">
                                    {{ \App\Http\Helpers\Translate::text($product->appointment->lang(), 'appointment_name') }}
                                </span>
                            </li>
                            <li class="info-list__item flex justify--space-between align-items--center">
                                <span class="info-list__label">{{ __('messages.Число монтажных отверстий') }}</span>
                                <span class="info-list__value">{{ $product->number_mounting_holes }}</span>
                            </li>
                            <li class="info-list__item flex justify--space-between align-items--center">
                                <span class="info-list__label">{{ __('messages.Код товара') }}</span>
                                <span class="info-list__value">{{ $product->product_code }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="inner-container margin-top-large margin-bottom-large">
            <h3 class="font-medium font-primary--bold margin-bottom-large">{{ __('messages.Возможно, вам понравится') }}</h3>
            @include('inc.carousels.carousel')
        </div>
    </div>

@endsection
