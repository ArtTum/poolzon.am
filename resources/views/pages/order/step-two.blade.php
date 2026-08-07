@extends('layouts.main')
@section('step', 'none')
@section('content')
<div class="order-container max-width-large">
    <div class="order-container__logo logo text-center">
        <img src="/images/logo.svg" alt="" />
    </div>
    <form method="post"  action="{{ '/order-two/'.App::getLocale() }}" enctype="multipart/form-data">
        @csrf
        <p class="margin-bottom-small">
            <a href="{{ \App\Http\Helpers\Helper::lang('step-one') }}" class="link link--primary link--with-icon">
                <span class="link__icon font-small"><i class="icon-arrow-left"></i></span>
                <span class="link__text">{{ __('messages.Назад') }}</span>
            </a>
        </p>
        <h1 class="title--primary font-large-xs font-primary--medium margin-bottom-medium">{{ __('messages.Адрес доставки') }}</h1>
        <div class="form margin-bottom-medium">
            <div id="city-disabled" class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md">
                    <input  style="background: #00000014;" type="text" disabled placeholder="" value="{{ __('Yerevan') }}" />
                    <span style="top: 5px" class="def-input__label">{{ __('messages.Город') }}</span>
                </div>
                <div style="display: none" id="qaxaqtext" class="form-control-feedback ">{{ __('messages.qaxaqtext') }}</div>
            </div>
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md {{ $errors->has('address') ? 'has-danger' : '' }}">
                    <input type="text" placeholder="" name="address" value="{{ old('address') ?? ($two['address'] ?? '')}}" />
                    <span class="def-input__label">{{ __('messages.Город , Улица *') }}</span>
                </div>
                @if ($errors->has('address'))
                    <div class="form-control-feedback ">{{ $errors->first('address') }}</div>
                @endif
            </div>

            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md {{ $errors->has('home') ? 'has-danger' : '' }}">
                    <input type="text" placeholder="" name="home" value="{{ old('home') ?? ($two['home'] ?? '') }}" />
                    <span class="def-input__label">{{ __('messages.Квартира / Дом') }}</span>
                </div>
                @if ($errors->has('home'))
                    <div class="form-control-feedback ">{{ $errors->first('home') }}</div>
                @endif
            </div>
            <div class="form__row-sm flex">
                <div class="form__col">
                    <div class="def-input def-input--secondary def-input--md {{ $errors->has('entrance') ? 'has-danger' : '' }}">
                        <input type="text" placeholder="" name="entrance" value="{{ old('entrance') ?? ($two['entrance'] ?? '') }}"  />
                        <span class="def-input__label">{{ __('messages.Подъезд') }}</span>
                    </div>
                    @if ($errors->has('entrance'))
                        <div class="form-control-feedback ">{{ $errors->first('entrance') ?? ($two['email'] ?? '') }}</div>
                    @endif
                </div>
                <div class="form__col">
                    <div class="def-input def-input--secondary def-input--md">
                        <input type="text" placeholder=""  name="floor" value="{{ old('floor') ?? ($two['floor'] ?? '') }}" />
                        <span class="def-input__label">{{ __('messages.Этаж') }}</span>
                    </div>
                </div>
            </div>
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md">
                    <input type="text" placeholder=""  name="intercom" value="{{ old('intercom') ?? ($two['intercom'] ?? '') }}" />
                    <span class="def-input__label">{{ __('messages.Домофон') }}</span>
                </div>
            </div>
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md">
                    <input type="text" placeholder=""  name="comment" value="{{ old('comment') ?? ($two['comment'] ?? '') }}" />
                    <span class="def-input__label">{{ __('messages.Комментарии') }}</span>
                </div>
            </div>
            <div class="form__row-sm text-box">
{{--                <p>Ближайший доставка будет 27 Марта,</p>--}}
{{--                <p class="font-primary--bold">Стоимость 1000 др</p>--}}
            </div>
        </div>
        <button class="def-button def-button--primary def-button--md width-percent-full">{{ __('messages.Продолжить') }}</button>
    </form>
    <br>
    <br>
</div>
@endsection
