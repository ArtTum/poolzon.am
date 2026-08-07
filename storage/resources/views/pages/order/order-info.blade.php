@extends('layouts.main')

@section('content')
<div class="order-info-container bg-light">
    <div class="inner-container">
        <div class="order-container max-width-large-extra">
            <div class="order-container__logo logo text-center margin-bottom-large">
                <img src="/images/logo.svg" alt="" />
            </div>
            <h1 class="title--primary font-large-xs font-primary--medium margin-bottom-large-xs text-center">
                Ваш заказ 24/01/2020 13:00
            </h1>
            <div class="block-container margin-bottom-medium">
                <div class="flex-table flex-table--secondary">
                    <div class="flex-table__row flex-table__row--head flex align-items--center">
                        <div class="flex-table__column inline-elements group-elements">
                            <a class="link link--primary link--with-icon">
                                <span class="link__icon"><i class="icon-print"></i></span>
                                <span class="link__text">Печатать</span>
                            </a>
                        </div>
                    </div>
                    <div class="flex-table__row flex flex--wrap align-items--stretch">
                        <div class="flex-table__column padding-right-medium">
                            <p><span class="font-primary--medium">Смеситель для мойки с высоким изливом</span> одноручный. Д22</p>
                        </div>
                        <div class="flex-table__column flex-table__column--small">
                            <div class="price price--sm">
                                <span class="price__actual no-wrap display--block">14, 256<span class="price__icon"><i class="icon-dram"></i></span></span>
                                <span class="price__discount no-wrap color-tertiary">16 266<span class="price__icon"><i class="icon-dram"></i></span></span>
                            </div>
                        </div>
                        <div class="flex-table__column flex-table__column--small text-right">
                           <span class="font-primary--medium font-medium">2 шт .</span>
                        </div>
                    </div>
                    <div class="flex-table__row flex flex--wrap align-items--stretch">
                        <div class="flex-table__column padding-right-medium">
                            <p><span class="font-primary--medium">Смеситель для мойки с высоким изливом</span> одноручный. Д22</p>
                        </div>
                        <div class="flex-table__column flex-table__column--small">
                            <div class="price price--sm">
                                <span class="price__actual no-wrap display--block">14, 256<span class="price__icon"><i class="icon-dram"></i></span></span>
                                <span class="price__discount no-wrap color-tertiary">16 266<span class="price__icon"><i class="icon-dram"></i></span></span>
                            </div>
                        </div>
                        <div class="flex-table__column flex-table__column--small text-right">
                            <span class="font-primary--medium font-medium">2 шт .</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-container cart-container__order order-box">
                <div class="block-container__inner">
                    <div class="flex align-items--center justify--space-between order-box__row">
                        <span class="order-box__col font-medium font-primary--medium">Ваш заказ</span>
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
            <div class="order-info-container__bottom text-center">
                <button class="def-button def-button--primary width-percent-full max-width-large">Продолжить покупки</button>
            </div>
        </div>
    </div>
</div>
@endsection
