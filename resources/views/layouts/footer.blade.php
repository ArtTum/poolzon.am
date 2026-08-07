<?php
$pages = \App\Models\Page::where('page_status', 1)->orderBy('order_number')->get();
?>
<footer class="footer bg-light">
    <div class="footer__inner inner-container flex flex--wrap justify--space-between">
        <div class="flex flex--wrap flex__item footer__left">
            <div class="flex__item footer__col">
                <h4 class="font-standard font-primary--bold">{{ __('messages.Помощь') }}</h4>
                <ul class="footer__links">
                    @foreach($pages as $page)
                        <li>
                            <a href="{{ \App\Http\Helpers\Helper::lang('page/'.$page->alias) }}">
                                {{ \App\Http\Helpers\Translate::text($page->lang(), 'page_name') }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="flex__item footer__col">
                <h4 class="font-standard font-primary--bold">{{ __('messages.Контакты') }}</h4>
                <ul class="footer__links">
                    <li><a href="mailto: info@poolzon.am"> info@poolzon.am </a></li>
                    <li><a href="tel:+37411392040">+374 11 39 20 40</a></li>
                </ul>
            </div>
            <div class="flex__item footer__col">
                <h4 class="font-standard font-primary--bold">{{ __('messages.Часы работы') }}</h4>
                <ul class="footer__links">
                    <li><a>{{ __('messages.Пн') }}</a></li>
                    <li><a>{{ __('messages.Сб') }}</a></li>
                    <li><a>{{ __('messages.Вс: закрыты') }}</a></li>
                </ul>
            </div>
            <div class="flex__item footer__col">
                <h4 class="font-standard font-primary--bold">{{ __('messages.Адрес') }}</h4>
                <ul class="footer__links">
                    <li>
                        <a>
                            {{ __('messages.Гарегин Нжде 16 51/1 Армения , Ереван') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex__item footer__right">
            <p class="margin-bottom-medium">&copy; 2009 – {{ date('Y') }} {{ __('messages.«Vagart». Все права защищены.') }}</p>
            @include('inc.social')
        </div>
    </div>
</footer>
