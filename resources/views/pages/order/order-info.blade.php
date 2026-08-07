@extends('layouts.main')
@section('step', 'none')
@section('content')
<div class="order-info-container bg-light">
    <div class="inner-container">
        <div class="order-container max-width-large-extra">
            <div class="order-container__logo logo text-center margin-bottom-large">
                <img src="/images/logo.svg" alt="" />
            </div>
            <h1 class="title--primary font-large-xs font-primary--medium margin-bottom-large-xs text-center">
                {{ __('messages.Ваш заказ') }} - {{ $_GET['order']??'' }}  {{ date("d/m/Y H:i") }}
            </h1>
            <div class="block-container margin-bottom-medium">
                <div class="flex-table flex-table--secondary">
                    <div class="flex-table__row flex-table__row--head flex align-items--center">
                        <div class="flex-table__column inline-elements group-elements">
                            <a onclick="window.print()" class="link link--primary link--with-icon">
                                <span class="link__icon"><i class="icon-print"></i></span>
                                <span class="link__text">{{ __('messages.Печатать') }}</span>
                            </a>
                        </div>
                    </div>
                    @foreach($cartCollection as $item)
                        <div class="flex-table__row flex flex--wrap align-items--stretch" id="item-{{ $item->id }}">
                            <a target="_blank" href="{{ \App\Http\Helpers\Helper::lang('product/'.\App\Models\Product::find($item->id)->alias) }}"
                               class="flex-table__column flex-table__column--small-xs">
                                <div class="cart-list__image bg-contain"
                                     style="background-image: url({{ $item->attributes->image }}"></div>
                            </a>
                            <div class="flex-table__column">
                                <div class="flex-table--sub flex flex--wrap-reverse">
                                    <div class="flex-table__column cart-list__desc">
                                        <p><span
                                                class="font-primary--medium">{{ \App\Http\Helpers\Translate::text(\App\Models\Product::find($item->id)->lang(), 'product_name') }}</span>
                                        </p>

                                    </div>
                                    <div class="flex-table__column flex-table__column--small">
                                        <div class="price price--sm">
                                            @if(\App\Models\Product::find($item->id)->sale)
                                                <span class="price__actual no-wrap color-pink">{{ number_format(\App\Models\Product::find($item->id)->price - (\App\Models\Product::find($item->id)->price * \App\Models\Product::find($item->id)->sale / 100)) }}<span
                                                        class="price__icon"><i
                                                            class="icon-dram"></i></span></span>
                                                <span class="price__discount no-wrap">{{ number_format(\App\Models\Product::find($item->id)->price) }}<span
                                                        class="price__icon"><i
                                                            class="icon-dram"></i></span>
                                                        </span>
                                            @else
                                                <span class="price__actual no-wrap">{{ number_format(\App\Models\Product::find($item->id)->price) }}<span
                                                        class="price__icon"><i
                                                            class="icon-dram"></i></span></span>

                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-table__column flex-table__column--small text-right">
                                        <span class="font-primary--medium font-medium">{{ $item->quantity }} {{ __('messages.шт') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="block-container cart-container__order order-box">
                <div class="block-container__inner">
                    <div class="flex align-items--center justify--space-between order-box__row">
                        <span class="order-box__col font-medium font-primary--medium"></span>
                        <span class="text-right order-box__count">{{ Cart::getTotalQuantity()}} {{ __('messages.товара') }}</span>
                    </div>
                    <div class="flex align-items--center justify--space-between order-box__row border border--top">
                        <span class="order-box__col font-medium font-primary--medium">{{ __('messages.Общая стоимость') }}</span>
                        <span class="text-right font-standard price">
                           <span class="price__actual no-wrap">{{ number_format(Cart::getTotal() + 1000) }}<span class="price__icon"><i class="icon-dram"></i></span></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="order-info-container__bottom text-center">
                <a style="color: white" href="{{ \App\Http\Helpers\Helper::lang() }}" class="def-button def-button--primary width-percent-full max-width-large">{{ __('messages.Продолжить покупки') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
