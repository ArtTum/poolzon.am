<?php

use App\Http\Helpers\Helper;
use App\Models\Lang;
use Illuminate\Support\Facades\App;

$languages = Helper::languageUrl();
$lang_ = Lang::where('iso', App::getLocale())->first();
$iso = ($lang_->iso == 'am') ? '' : $lang_->iso . '/';

?>
<header class="header" style="display: @yield('step')">
    <div class="header__bg">
        <div class="header__inner inner-container flex justify--space-between align-items--center">
            <button class="header__nav def-button def-button--icon show-for-tablet" onclick="toggleClass('navigation')">
                <i class="icon-nav"></i>
            </button>
            <div class="logo">
                <a href="{{ \App\Http\Helpers\Helper::lang() }}">
                    <img src="/images/logo.svg" alt=""/>
                </a>
            </div>
            <div class="flex__item flex justify--space-between header__center">
                <button
                    class="flex__item def-button def-button--primary max-width-medium font-primary--bold hide-for-tablet"
                    onclick="toggleClass('navigation')">{{ __('messages.Каталог') }}
                </button>
                <form class="flex__item group header__search search-box flex" action="{{ \App\Http\Helpers\Helper::lang('search') }}" method="GET">
                    <div class="flex__item group__input search-box__input def-input def-input--primary-color"
                         id="searchBox">
                        <input type="text" name="q" placeholder="{{ __('messages.Searching for..') }}"/>
                    </div>
                    <button type="button" class="group__button def-button def-button--icon" onclick="toggleClass('searchBox')">
                        <i class="icon-search"></i>
                    </button>
                </form>
            </div>
            <div class="header__right flex">
                <a href="{{ \App\Http\Helpers\Helper::lang('favorites') }}" class="header__cart cart-button def-button def-button--icon">
                    <i class="icon-favorite"></i>
                    <span class="favorites-button__count">
                        <span class="wish-list-count">
                            @if(session('favorites'))
                                {{ count( session('favorites'))  }}
                            @else
                                0
                            @endif
                        </span>
                    </span>
                </a>

                <a href="{{ \App\Http\Helpers\Helper::lang('cart') }}" class="header__cart cart-button def-button def-button--icon">
                    <i class="icon-cart"></i>
                    <span class="cart-button__count">{{ \Cart::getTotalQuantity()}}</span>
                </a>
                <div class="header__language hide-for-sm-mobile margin-left-small-xs">
                    @if(isset($languages))
                    <span class="language-box" id="langBox">
                        <span class="language-box__selected-item hide-for-sm-mobile"
                              onclick="toggleBoxes('langList', 'langBox')">{{ $lang_->iso }}</span>
                        <div class="language-box__list" id="langList">
                            <ul>
                                @foreach($languages  as $lang)
                                <li class="language-box__item {{$lang_->iso == $lang['iso'] ? 'active' : ''}}">
                                    <a class="language-box__item {{$lang_->iso == $lang['iso'] ? 'active' : ''}}"
                                       href="{{ $lang['url'] }}">{{ $lang['lang_name'] }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('inc.navigation')
</header>
<style>
    .header .favorites-button__count {
        display: block;
        width: 15px;
        height: 15px;
        text-align: center;
        line-height: 15px;
        font-size: 8px;
        position: absolute;
        top: 4px;
        right: 4px;
        color: #ffffff;
        background-color: #F91155;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
    }
</style>
