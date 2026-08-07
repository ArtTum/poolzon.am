<form class="filter" action="" method="GET">
    <div id="defaultOpen" class="form__row price-box">
        <p class="label margin-bottom-medium">{{ __('messages.Цена') }}</p>
        <div  class="price-box__slider margin-bottom-medium slider-range"></div>
        <div class="group flex align-items--center justify--space-between">
            <div class="flex__item flex align-items--center margin-right-medium">
                <span class="group__label">{{ __('messages.от') }}</span>
                <div class="def-input def-input--small flex__item">
                    <input  type="number" min=0 max="9900" oninput="validity.valid||(value='0');" name="min-price" class="min_price" />
                </div>
            </div>
            <div class="flex__item flex align-items--center">
                <span class="group__label">{{ __('messages.до') }}</span>
                <div class="def-input def-input--small flex__item">
                    <input  type="number" min=0 max="100000" oninput="validity.valid||(value='100000');" name="max-price" class="max_price" />
                </div>
            </div>
        </div>
    </div>
    <div class="form__row">
        <label class="switch flex justify--space-between">
            <span class="switch__text label">{{ __('messages.Товары со скидкой') }}</span>
            <input class="sale" name="sale" type="checkbox" {{ isset($_GET['sale']) ? 'checked=checked' : '' }}>
            <span></span>
        </label>
    </div>
    <div class="form__row">
        <label class="switch flex justify--space-between">
            <span class="switch__text label">{{ __('messages.Бестселлер') }}</span>
            <input class="bestseller" name="bestseller" type="checkbox" {{ isset($_GET['bestseller']) ? 'checked=checked' : '' }}>
            <span></span>
        </label>
    </div>
</form>

<script>
    var values = ["{{ $_GET['min-price']??0 }}", "{{ $_GET['max-price']??100000 }}"];
</script>
