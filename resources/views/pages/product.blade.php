<div class="row row-flex flex flex--wrap align-items--stretch">
    @foreach($products as $k => $product)
        <div class="col-4 col-xs-6 margin-bottom-large">
            <div class="product-item">
                <div class="product-item__img bg-contain"
                     style="background-image: url({{ '/uploads/products/'.$product->product_image }});">
                    <a href="{{ \App\Http\Helpers\Helper::lang('product/'.$product->alias) }}"></a>
                    <span class="product-item__icon favorite {{ 'f-'.$product->id }} {{ in_array($product->id, $favorites ?? []) ? 'active' : '' }}"  onclick="addFavorite( {{ $product->id }} )">
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
                        <form class="add-cart" action="/add" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $product->id }}" name="id">
                            <input type="hidden" value="{{ \App\Http\Helpers\Translate::text($product->lang(), 'product_name') }}" name="name">
                            <input type="hidden" value="{{ $product->sale ? ($product->price - ($product->price * $product->sale / 100)) : $product->price}}" name="price">
                            <input type="hidden" value="{{ '/uploads/products/'.$product->product_image }}"  name="img">
                            <input type="hidden" value="1"  name="quantity">
                            <button onclick="updateCart(this.form)" {{ $product->product_count == 0 ? 'disabled=disabled' : false}} type="reset" class="def-button def-button--primary def-button--icon-left {{ $product->product_count == 0 ? 'disabled' : false}}">
                                <span class="def-button__icon"><i class="icon-cart"></i></span>
                                <span class="def-button__text">{{ $product->product_count == 0 ? __('messages.disabled') : __('messages.В корзину')}}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if($k == 5 && $banners->count() > 0)
            <div class="col-12 col-md-12 page-container___right">
                @include('inc.sliders.adds-slider')
            </div>
        @endif
    @endforeach
</div>
