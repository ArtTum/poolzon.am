@extends('layouts.main')

@section('content')
<div class="order-container--secondary bg-light margin-bottom-large">
    <div class="inner-container">
        <h1 class="title--primary font-large-xs font-primary--medium margin-bottom-small">Оформление заказа</h1>
        <p class="margin-bottom-large"><a href="" class="link link--primary">Вернуться в корзину</a></p>
        <div class="row row-flex flex flex--wrap">
            <div class="col-8 col-md-12 cart-container__left">
                <div class="row row-flex flex flex--wrap align-items--stretch">
                    <div class="col-7 col-xs-12">
                        <div class="block-container">
                            <div class="flex-table flex-table--tertiary">
                                <div class="flex-table__row flex-table__row--head flex align-items--center">
                                    <div class="flex-table__column flex align-items--center justify--space-between">
                                        <span>Адрес доставки</span>
                                        <a class="link link--primary" onclick="openModal('addressModal')">Изменить</a>
                                    </div>
                                </div>
                                <div class="flex-table__row flex">
                                    <div class="flex-table__column"><span>Город , Улица</span></div>
                                    <div class="flex-table__column"><span>Yerevan, Sehngavit 4 st.</span></div>
                                </div>
                                <div class="flex-table__row flex">
                                    <div class="flex-table__column"><span>Квартира / Дом</span></div>
                                    <div class="flex-table__column"><span>44</span></div>
                                </div>
                                <div class="flex-table__row flex">
                                    <div class="flex-table__column"><span>Подъезд</span></div>
                                    <div class="flex-table__column"><span>5</span></div>
                                </div>
                                <div class="flex-table__row flex">
                                    <div class="flex-table__column"><span>Этаж</span></div>
                                    <div class="flex-table__column"><span>4</span></div>
                                </div>
                                <div class="flex-table__row flex">
                                    <div class="flex-table__column"><span>Домофон</span></div>
                                    <div class="flex-table__column"><span>5245</span></div>
                                </div>
                                <div class="flex-table__row flex">
                                    <div class="flex-table__column"><span>Комментарии</span></div>
                                    <div class="flex-table__column"><span>Ivan</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 col-xs-12">
                        <div class="block-container payment">
                            <div class="flex-table flex-table--secondary">
                                <div class="flex-table__row flex-table__row--head flex align-items--center">
                                    <div class="flex-table__column"><span>Способ оплаты</span></div>
                                </div>
                                <div class="flex-table__row">
                                    <div class="flex-table__column">
                                        <label class="def-radio flex align-items--center justify--space-between width-percent-full">
                                            <span class="flex align-items--center padding-right-small">
                                                <span class="payment__icon"><i class="icon-card"></i></span>
                                                <span>Картой онлайн</span>
                                            </span>
                                            <span>
                                                <input type="radio" name="payment-type" checked/>
                                                <span></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex-table__row ">
                                    <div class="flex-table__column">
                                        <label class="def-radio flex align-items--center justify--space-between width-percent-full">
                                            <span class="flex align-items--center padding-right-small">
                                                <span class="payment__icon"><i class="icon-cash"></i></span>
                                                <span>Оплата наличными</span>
                                            </span>
                                            <span>
                                                <input type="radio" name="payment-type" checked/>
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
                        <div class="flex align-items--center justify--space-between order-box__row">
                            <span class="order-box__col">Доставка</span>
                            <span class="text-right font-primary--medium font-standard no-wrap">
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

<div class="inner-container margin-top-large margin-bottom-large">
    <h3 class="font-medium font-primary--bold margin-bottom-large">Ваши заказы</h3>
    <div class="row row-flex flex flex--wrap align-items--stretch">
        <?php for($i=1; $i<=4; $i++ ) { ?>
        <div class="col-5 col-md-6 col-xs-12 margin-bottom-large-xs">
            <div class="product-item product-item--secondary flex">
                <div class="product-item__img bg-contain" style="background-image: url('/images/products/1.png');">
                    <a href="index.php?page=product-view"></a>
                    </span>
                </div>
                <div class="product-item__info">
                    <p class="product-item__title">
                        <a href="index.php?page=product-view"><span class="font-primary--medium display--block">Люк полимерный квадратный</span><span>серый 685x685x60</span></a>
                    </p>
                    <div class="product-item__price price price--sm margin-top-small">
                        <p class="price__actual no-wrap">14 256<span class="price__icon"><i class="icon-dram"></i></span></p>
                        <p class="price__discount no-wrap color-tertiary">16 266<span class="price__icon"><i class="icon-dram"></i></span></p>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
@endsection
