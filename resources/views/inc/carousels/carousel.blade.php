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
                @if($product->sale)
                    <span class="discount margin-bottom-small">-{{ $product->sale }}%</span>
                @endif
                <div class="product-item__price price margin-bottom-small">
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
                <p class="product-item__type font-primary--medium margin-bottom-small-xs">
                    @if($product->bestseller == 1)
                        {{ __('messages.Бестселлер') }}
                    @endif
                </p>
                <p class="product-item__title">
                    <a href="{{ \App\Http\Helpers\Helper::lang('product/'.$product->alias) }}">
                                            <span class="font-primary--medium display--block">
                                                {{ \App\Http\Helpers\Translate::text($product->lang(), 'product_name') }}
                                            </span>
                    </a>
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
