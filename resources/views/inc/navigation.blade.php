<div class="navigation" id="navigation">
<!--    <span class="navigation__close"><i class="icon-close"></i></span>-->
    <div class="navigation__scroll scroll">
        <div class="inner-container flex align-items--stretch flex--wrap">
            <div class="flex__item navigation__col">
                <h4 class="font-primary--bold font-medium margin-bottom-medium">{{ __('messages.Категория') }}</h4>
                @include('inc.category-list')
            </div>

            <div class="flex__item navigation__col show-for-tablet">
                <div class="max-width-large">
                    @include('inc.filter')
                </div>
            </div>
            <div class="flex__item navigation__col hide-for-mobile">
                <div class="navigation__banner bg-cover"  style="background-image: url('/images/4.jpg')"></div>
            </div>
        </div>
    </div>
    <div class="navigation__language show-for-sm-mobile">
        @include('inc.language')
    </div>
</div>
