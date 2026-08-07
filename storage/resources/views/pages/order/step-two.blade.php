@extends('layouts.main')

@section('content')
<div class="order-container max-width-large">
    <div class="order-container__logo logo text-center">
        <img src="/images/logo.svg" alt="" />
    </div>
    <form>
        <p class="margin-bottom-small">
            <a href="" class="link link--primary link--with-icon">
                <span class="link__icon font-small"><i class="icon-arrow-left"></i></span>
                <span class="link__text">Назад</span>
            </a>
        </p>
        <h1 class="title--primary font-large-xs font-primary--medium margin-bottom-medium">Адрес доставки</h1>
        <div class="form margin-bottom-medium">
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md">
                    <input type="text" placeholder="" />
                    <span class="def-input__label">Город , Улица *</span>
                </div>
            </div>
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md">
                    <input type="number" placeholder="" />
                    <span class="def-input__label">Квартира / Дом</span>
                </div>
            </div>
            <div class="form__row-sm flex">
                <div class="form__col">
                    <div class="def-input def-input--secondary def-input--md">
                        <input type="number" placeholder="" />
                        <span class="def-input__label">Подъезд</span>
                    </div>
                </div>
                <div class="form__col">
                    <div class="def-input def-input--secondary def-input--md">
                        <input type="number" placeholder="" />
                        <span class="def-input__label">Этаж</span>
                    </div>
                </div>
            </div>
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md">
                    <input type="text" placeholder="" />
                    <span class="def-input__label">Домофон</span>
                </div>
            </div>
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md">
                    <input type="text" placeholder="" />
                    <span class="def-input__label">Комментарии</span>
                </div>
            </div>
            <div class="form__row-sm text-box">
                <p>Ближайший доставка будет 27 Марта,</p>
                <p class="font-primary--bold">Стоимость 1000 др</p>
            </div>
        </div>
        <button class="def-button def-button--primary def-button--md width-percent-full">Продолжить</button>
    </form>
</div>
@endsection
