@extends('layouts.main')

@section('content')

    <div class="page-container__inner cart-container bg-light">
    <div class="inner-container">
        <h1 class="title--primary font-large-xs font-primary--medium margin-bottom-medium-lg">Корзина</h1>
        <div class="row row-flex flex flex--wrap">
            <div class="col-8 col-md-12 cart-container__left">
                <div class="block-container">
                    <div class="flex-table flex-table--bordered cart-list">
                        <div class="flex-table__row flex-table__row--head flex align-items--center">
                            <div class="flex-table__column inline-elements group-elements">
                                <span class="group-elements__col">
                                    <label class="def-checkbox">
                                        <input type="checkbox" name=""/>
                                        <span><i class="icon-check"></i></span>
                                        <span class="def-checkbox__text">Выбрать все</span>
                                    </label>
                                </span>
                                <span class="group-elements__col">
                                    <button class="def-button def-button--secondary def-button--tertiary">Удалить выбранные</button>
                                </span>
                            </div>
                        </div>
                        <div class="flex-table__row flex flex--wrap align-items--stretch">
                            <div class="flex-table__column flex-table__column--check">
                                <label class="def-checkbox">
                                    <input type="checkbox" name=""/>
                                    <span><i class="icon-check"></i></span>
                                </label>
                            </div>
                            <div class="flex-table__column flex-table__column--small-xs">
                                <div class="cart-list__image bg-contain" style="background-image: url('/images/products/1.png');"></div>
                            </div>
                            <div class="flex-table__column">
                                <div class="flex-table--sub flex flex--wrap-reverse">
                                    <div class="flex-table__column cart-list__desc">
                                        <p><span class="font-primary--medium">Смеситель для мойки с высоким изливом</span> одноручный. Д22</p>
                                        <div class="inline-elements group-elements cart-list__actions">
                                            <span class="group-elements__col">
                                                 <button class="def-button def-button--secondary def-button--icon-left">
                                                    <span class="def-button__icon"><i class="icon-favorite"></i></span>
                                                    <span class="def-button__text">В избранное</span>
                                                </button>
                                            </span>
                                            <span class="group-elements__col">
                                                <button class="def-button def-button--secondary">Удалить</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-table__column flex-table__column--small">
                                        <div class="price price--sm">
                                            <span class="price__actual no-wrap display--block">14, 256<span class="price__icon"><i class="icon-dram"></i></span></span>
                                            <span class="price__discount no-wrap color-tertiary">16 266<span class="price__icon"><i class="icon-dram"></i></span></span>
                                        </div>
                                    </div>
                                    <div class="flex-table__column flex-table__column--small">
                                        <div class="def-select-box def-select-box--small max-width-small"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-table__row flex flex--wrap align-items--stretch">
                            <div class="flex-table__column flex-table__column--check">
                                <label class="def-checkbox">
                                    <input type="checkbox" name=""/>
                                    <span><i class="icon-check"></i></span>
                                </label>
                            </div>
                            <div class="flex-table__column flex-table__column--small-xs">
                                <div class="cart-list__image bg-contain" style="background-image: url('/images/products/2.png');"></div>
                            </div>
                            <div class="flex-table__column">
                                <div class="flex-table--sub flex flex--wrap-reverse">
                                    <div class="flex-table__column cart-list__desc">
                                        <p><span class="font-primary--medium">Смеситель для мойки с высоким изливом</span> одноручный. Д22</p>
                                        <div class="inline-elements group-elements cart-list__actions">
                                            <span class="group-elements__col">
                                                 <button class="def-button def-button--secondary def-button--icon-left">
                                                    <span class="def-button__icon"><i class="icon-favorite"></i></span>
                                                    <span class="def-button__text">В избранное</span>
                                                </button>
                                            </span>
                                            <span class="group-elements__col">
                                                <button class="def-button def-button--secondary">Удалить</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-table__column flex-table__column--small">
                                        <div class="price price--sm">
                                            <span class="price__actual no-wrap display--block">14, 256<span class="price__icon"><i class="icon-dram"></i></span></span>
                                            <span class="price__discount no-wrap color-tertiary">16 266<span class="price__icon"><i class="icon-dram"></i></span></span>
                                        </div>
                                    </div>
                                    <div class="flex-table__column flex-table__column--small">
                                        <div class="def-select-box def-select-box--small max-width-small"></div>
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
                            <span class="order-box__col font-medium font-primary--medium">Ваша корзина</span>
                            <span class="text-right order-box__count">2 товара</span>
                        </div>
                        <div class="flex align-items--center justify--space-between order-box__row">
                            <span class="order-box__col">Цена товаров</span>
                            <span class="text-right font-primary--medium font-standard no-wrap">
                                 14, 256<span class="font-small margin-left-small-xs"><i class="icon-dram"></i></span>
                            </span>
                        </div>
                        <div class="flex align-items--center justify--space-between order-box__row">
                            <span class="order-box__col">Скидка</span>
                            <span class="text-right font-primary--medium font-standard no-wrap color-pink">
                               14, 256<span class="font-small margin-left-small-xs"><i class="icon-dram"></i></span>
                            </span>
                        </div>
                        <div class="flex align-items--center justify--space-between order-box__row border border--top">
                            <span class="order-box__col font-medium font-primary--medium">Общая стоимость</span>
                            <span class="text-right font-standard price">
                               <span class="price__actual no-wrap">14, 256<span class="price__icon"><i class="icon-dram"></i></span></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="block-container">
                    <div class="block-container__inner">
                        <button class="def-button def-button--primary width-percent-full">Оформить заказ</button>
                        <p class="font-small color-tertiary margin-top-small text-box">Доставка в Ереване 1000 др. / за пределом Еревана + 150 др. за километр</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
