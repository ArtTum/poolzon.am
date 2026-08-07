@extends('layouts.main')
@section('step', 'none')
@section('content')
<div class="order-container--secondary bg-light margin-bottom-large">
    <div class="inner-container">
        <h1 class="title--primary font-large-xs font-primary--medium margin-bottom-small">{{ __('messages.Оформление заказа') }}</h1>
        <p class="margin-bottom-large">
            <a href="{{ \App\Http\Helpers\Helper::lang('cart') }}" class="link link--primary">{{ __('messages.Вернуться в корзину') }}</a>
        </p>
        <form method="post"  action="{{ '/order/'.App::getLocale() }}" class="row row-flex flex flex--wrap">
            @csrf
            <div class="col-8 col-md-12 cart-container__left">
                <div class="row row-flex flex flex--wrap align-items--stretch">
                    <div class="col-7 col-xs-12">
                        <div class="block-container">
                            <div class="flex-table flex-table--tertiary">
                                <div class="flex-table__row flex-table__row--head flex align-items--center">
                                    <div class="flex-table__column flex align-items--center justify--space-between">
                                        <span>{{ __('messages.Адрес доставки') }}</span>
                                        <a class="link link--primary" href="{{ \App\Http\Helpers\Helper::lang('step-two') }}">
                                            {{ __('messages.Изменить') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="flex-table__row flex">
                                    <div class="flex-table__column"><span>{{ __('messages.Город , Улица') }}</span></div>
                                    <div class="flex-table__column"><span>{{ $two['address'] }}</span></div>
                                </div>
                                <div class="flex-table__row flex">
                                    <div class="flex-table__column"><span>{{ __('messages.Квартира / Дом') }}</span></div>
                                    <div class="flex-table__column"><span>{{ $two['home'] }}</span></div>
                                </div>
                                <div class="flex-table__row flex">
                                    <div class="flex-table__column"><span>{{ __('messages.Подъезд') }}</span></div>
                                    <div class="flex-table__column"><span>{{ $two['entrance'] }}</span></div>
                                </div>
                                <div class="flex-table__row flex">
                                    <div class="flex-table__column"><span>{{ __('messages.Этаж') }}</span></div>
                                    <div class="flex-table__column"><span>{{ $two['floor'] }}</span></div>
                                </div>
                                <div class="flex-table__row flex">
                                    <div class="flex-table__column"><span>{{ __('messages.Домофон') }}</span></div>
                                    <div class="flex-table__column"><span>{{ $two['intercom'] }}</span></div>
                                </div>
                                <div class="flex-table__row flex">
                                    <div class="flex-table__column"><span>{{ __('messages.Комментарии') }}</span></div>
                                    <div class="flex-table__column"><span>{{ $two['comment'] }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 col-xs-12">
                        <div class="block-container payment">
                            <div class="flex-table flex-table--secondary">
                                <div class="flex-table__row flex-table__row--head flex align-items--center">
                                    <div class="flex-table__column"><span>{{ __('messages.Способ оплаты') }}</span></div>
                                </div>
{{--                                <div class="flex-table__row">--}}
{{--                                    <div class="flex-table__column">--}}
{{--                                        <label class="def-radio flex align-items--center justify--space-between width-percent-full">--}}
{{--                                            <span class="flex align-items--center padding-right-small">--}}
{{--                                                <span class="payment__icon"><i class="icon-card"></i></span>--}}
{{--                                                <span>{{ __('messages.Картой онлайн') }}</span>--}}
{{--                                            </span>--}}
{{--                                            <span>--}}
{{--                                                <input type="radio" name="payment_type" value="online" checked/>--}}
{{--                                                <span></span>--}}
{{--                                            </span>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="flex-table__row ">
                                    <div class="flex-table__column">
                                        <label class="def-radio flex align-items--center justify--space-between width-percent-full">
                                            <span class="flex align-items--center padding-right-small">
                                                <span class="payment__icon"><i class="icon-cash"></i></span>
                                                <span>{{ __('messages.Оплата наличными') }}</span>
                                            </span>
                                            <span>
                                                <input type="radio" name="payment_type" value="default"/>
                                                <span></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 col-md-12">
                <div class="block-container cart-container__order order-box">
                    <div class="block-container__inner">
                        <div class="flex align-items--center justify--space-between order-box__row">
                                    <span
                                        class="order-box__col font-medium font-primary--medium">{{ __('messages.Ваша корзина') }}</span>
                            <span
                                class="text-right order-box__count"><span class="total-count">{{ Cart::getTotalQuantity()}}</span>  {{ __('messages.товара') }}</span>
                        </div>
                        <div class="flex align-items--center justify--space-between order-box__row">
                            <span class="order-box__col">{{ __('messages.Доставка') }} </span>
                            <span class="text-right font-primary--medium font-standard no-wrap">
                                 3900<span class="font-small margin-left-small-xs"><i class="icon-dram"></i></span>
                            </span>
                        </div>
                        <div class="flex align-items--center justify--space-between order-box__row border border--top">
                            <span class="order-box__col font-medium font-primary--medium">{{ __('messages.Общая стоимость') }}</span>
                            <span class="text-right font-standard price">
                               <span class="price__actual no-wrap"><span class="total-price">{{ number_format(Cart::getTotal() + 3900)  }}</span><span class="price__icon"><i class="icon-dram"></i></span></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="block-container">
                    <div class="block-container__inner">
                        <button class="def-button def-button--primary width-percent-full">{{ __('messages.Оформить заказ') }}</button>
                        <p class="font-small color-tertiary margin-top-small text-box">{{ __('messages.Доставка в Ереване 1000 др. / за пределом Еревана + 150 др. за километр') }}</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="inner-container margin-top-large margin-bottom-large">
    <h3 class="font-medium font-primary--bold margin-bottom-large">{{ __('messages.Ваши заказы') }}</h3>
    <div class="row row-flex flex flex--wrap align-items--stretch">
        @foreach($cartCollection as $item)
        <div class="col-5 col-md-6 col-xs-12 margin-bottom-large-xs">
            <div class="product-item product-item--secondary flex">
                <div class="product-item__img bg-contain" style="background-image: url({{ $item->attributes->image }});">
                    <a href="index.php?page=product-view"></a>
                </div>
                <div class="product-item__info">
                    <p class="product-item__title">
                   <span
                       class="font-primary--medium">{{ \App\Http\Helpers\Translate::text(\App\Models\Product::find($item->id)->lang(), 'product_name') }}</span></p>
                    <div class="product-item__price price price--sm margin-top-small">
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
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
