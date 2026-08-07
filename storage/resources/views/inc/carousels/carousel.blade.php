<div class="slider simple-carousel relative">
    <?php for($i=1; $i<=6; $i++ ): ?>
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
    <?php endfor;?>
</div>
