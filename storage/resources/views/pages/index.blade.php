@extends('layouts.main')

@section('content')

@include('inc.sliders.main-slider')
<div class="logo-list bg-middle-light hide-for-mobile">
    <div class="inner-container flex align-items--center justify--space-around">
        <?php for ($i = 1; $i <= 8; $i++) { ?>
            <a href="" class="logo-list__item"><img src="/images/logos/<?php echo $i ?>.png" alt=""></a>
        <?php } ?>
    </div>
</div>

<div class="inner-container margin-top-large">
    <div class="row clearfix">
        <div class="col-3 page-container__left hide-for-tablet">
            @include('inc.sliders.main-slider')
        </div>
        <div class="col-9 col-md-12 page-container___right">
            <div class="row row-flex flex flex--wrap align-items--stretch">
                <?php for ($i = 1; $i <= 6; $i++) { ?>
                    <div class="col-4 col-xs-6 margin-bottom-large">
                        <div class="product-item">
                            <div class="product-item__img bg-contain" style="background-image: url('/images/products/2.png');">
                                <a href="index.php?page=product-view"></a>
                                <span class="product-item__icon favorite">
                                    <i class="icon-favorite"></i>
                                </span>
                            </div>
                            <div class="product-item__info">
                                <span class="discount margin-bottom-small">-25%</span>
                                <div class="product-item__price price margin-bottom-small">
                                    <span class="price__actual no-wrap color-pink">14 256<span class="price__icon"><i class="icon-dram"></i></span></span>
                                    <span class="price__discount no-wrap">16 266<span class="price__icon"><i class="icon-dram"></i></span></span>
                                </div>
                                <p class="product-item__type font-primary--medium margin-bottom-small-xs">Бестселлер</p>
                                <p class="product-item__title">
                                    <a href="index.php?page=product-view"><span class="font-primary--medium display--block">Люк полимерный квадратный</span><span>серый 685x685x60</span></a>
                                </p>
                                <div class="product-item__button">`
                                    <button class="def-button def-button--primary def-button--icon-left">
                                        <span class="def-button__icon"><i class="icon-cart"></i></span>
                                        <span class="def-button__text">В корзину</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            @include('inc.sliders.adds-slider')
            <div class="row row-flex flex flex--wrap align-items--stretch">
                <?php for ($i = 1; $i <= 6; $i++) { ?>
                    <div class="col-4 col-xs-6 margin-bottom-large">
                        <div class="product-item">
                            <div class="product-item__img bg-contain" style="background-image: url('/images/products/2.png');">
                                <a href="index.php?page=product-view"></a>
                                <span class="product-item__icon favorite">
                                    <i class="icon-favorite"></i>
                                </span>
                            </div>
                            <div class="product-item__info">
                                <span class="discount margin-bottom-small">-25%</span>
                                <div class="product-item__price price margin-bottom-small">
                                    <span class="price__actual no-wrap color-pink">14 256<span class="price__icon"><i class="icon-dram"></i></span></span>
                                    <span class="price__discount no-wrap">16 266<span class="price__icon"><i class="icon-dram"></i></span></span>
                                </div>
                                <p class="product-item__type font-primary--medium margin-bottom-small-xs">Бестселлер</p>
                                <p class="product-item__title">
                                    <a href="index.php?page=product-view"><span class="font-primary--medium display--block">Люк полимерный квадратный</span><span>серый 685x685x60</span></a>
                                </p>
                                <div class="product-item__button">
                                    <button class="def-button def-button--primary def-button--icon-left">
                                        <span class="def-button__icon"><i class="icon-cart"></i></span>
                                        <span class="def-button__text">В корзину</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
@endsection
