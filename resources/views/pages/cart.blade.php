@extends('layouts.main')

@section('content')

    <div class="page-container__inner cart-container bg-light">
        <div class="inner-container">
            <h1 class="title--primary font-large-xs font-primary--medium margin-bottom-medium-lg">{{ __('messages.Корзина') }}</h1>
            <div class="row row-flex flex flex--wrap">
                @if(Cart::getTotalQuantity()>0)
                <div class="col-8 col-md-12 cart-container__left">

                    <div class="block-container">
                        <div class="flex-table flex-table--bordered cart-list">
                            <div class="flex-table__row flex-table__row--head flex align-items--center">
                                <div class="flex-table__column inline-elements group-elements">
                                <span class="group-elements__col">
                                    <label class="def-checkbox">
                                        <input type="checkbox" name="selectAll" id="selectAllDomainList"/>
                                        <span><i class="icon-check"></i></span>
                                        <span class="def-checkbox__text">{{ __('messages.Выбрать все') }}</span>
                                    </label>
                                </span>
                                    <span class="group-elements__col">
                                    <button id="remove-all"
                                        class="def-button def-button--secondary def-button--tertiary">{{ __('messages.Удалить выбранные') }}</button>
                                </span>
                                </div>
                            </div>
                            @foreach($cartCollection as $item)
                                <div class="flex-table__row flex flex--wrap align-items--stretch" id="item-{{ $item->id }}">
                                    <div class="flex-table__column flex-table__column--check">
                                        <label class="def-checkbox">
                                            <input type="checkbox" name="domainList" value="{{ $item->id }}"/>
                                            <span><i class="icon-check"></i></span>
                                        </label>
                                    </div>
                                    <a href="{{ \App\Http\Helpers\Helper::lang('product/'.\App\Models\Product::find($item->id)->alias) }}"
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
                                                <div class="inline-elements group-elements cart-list__actions">
                                            <span class="group-elements__col">
                                                 <button class="def-button def-button--secondary def-button--icon-left">
                                                    <span class="def-button__icon"><i class="icon-favorite"></i></span>
                                                    <span
                                                        class="def-button__text">{{ __('messages.В избранное') }}</span>
                                                </button>
                                            </span>
                                                    <span class="group-elements__col">
                                                    <form class="remove-cart" action="/remove" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                                        <button
                                                            class="def-button def-button--secondary">{{ __('messages.Удалить') }}</button>
                                                    </form>
                                            </span>
                                                </div>
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
                                            <div class="flex-table__column flex-table__column--small">
                                                <form class="update-cart" action="/update" method="POST">
                                                    {{ csrf_field() }}
                                                    <div class="form-group row">
                                                        <input type="hidden" value="{{ $item->id}}" name="id">
                                                        <input type="hidden" value="{{ $item->quantity }}" name="oldQuantity" id="old-count-{{ $item->id }}">
                                                        <select onchange="updateCart(this.form)" class="form-control form-control-sm" name="quantity" style="min-width: 70px;">
                                                            @for($c = 1; $c <= \App\Models\Product::find($item->id)->product_count; $c++)
                                                                <option {{ $item->quantity == $c ? 'selected=selected' : '' }} value="{{ $c }}">{{ $c }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-12">
                    <div class="block-container cart-container__order order-box">
                        @if(Cart::getTotalQuantity()>0)
                            <div class="block-container__inner">
                                <div class="flex align-items--center justify--space-between order-box__row">
                                    <span
                                        class="order-box__col font-medium font-primary--medium">{{ __('messages.Ваша корзина') }}</span>
                                    <span
                                        class="text-right order-box__count"><span class="total-count">{{ Cart::getTotalQuantity()}}</span>  {{ __('messages.товара') }}</span>
                                </div>

                                <div
                                    class="flex align-items--center justify--space-between order-box__row border border--top">
                                    <span
                                        class="order-box__col font-medium font-primary--medium">{{ __('messages.Общая стоимость') }}</span>
                                    <span class="text-right font-standard price">
                                    <span class="price__actual no-wrap">
                                        <span class="total-price">{{ number_format(Cart::getTotal()) }}</span>
                                        <span class="price__icon">
                                            <i class="icon-dram"></i>
                                        </span>
                                    </span>
                            </span>
                                </div>
                            </div>
                        @else
                            <h4>No Product(s) In Your Cart</h4><br>
                            <a href="/" class="btn btn-dark">Continue Shopping</a>
                        @endif
                    </div>
                    <div class="block-container">
                        <div class="block-container__inner">
                            <a href="{{ \App\Http\Helpers\Helper::lang('step-one') }}" style="color: white"
                                class="def-button def-button--primary width-percent-full">{{ __('messages.Оформить заказ') }}</a>
                            <p class="font-small color-tertiary margin-top-small text-box">
                                {{ __('messages.Доставка в Ереване 1000 др. / за пределом Еревана + 150 др. за километр') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
