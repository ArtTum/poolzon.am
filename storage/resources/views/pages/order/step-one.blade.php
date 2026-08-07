@extends('layouts.main')

@section('content')
<div class="order-container max-width-large">
    <div class="order-container__logo logo text-center">
        <img src="/images/logo.svg" alt="" />
    </div>
    <form>
        <h1 class="title--primary font-large-xs font-primary--medium margin-bottom-small">Ваши данные</h1>
        <p class="sub-title margin-bottom-medium">Данные для оформления заказа</p>
        <div class="form margin-bottom-large-xs">
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md">
                    <input type="email" placeholder="" />
                    <span class="def-input__label">Емайл *</span>
                </div>
            </div>
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md">
                    <input type="text" placeholder="" />
                    <span class="def-input__label">Имя *</span>
                </div>
            </div>
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md">
                    <input type="text" placeholder="" />
                    <span class="def-input__label">Фамилия *</span>
                </div>
            </div>
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md">
                    <input type="text" placeholder="" />
                    <span class="def-input__label">Телефон *</span>
                </div>
            </div>
        </div>
        <h1 class="title--primary font-large-xs font-primary--medium margin-bottom-small">Данные получателя</h1>
        <div class="form margin-bottom-medium">
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md">
                    <input type="text" placeholder="" />
                    <span class="def-input__label">Имя *</span>
                </div>
            </div>
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md">
                    <input type="text" placeholder="" />
                    <span class="def-input__label">Фамилия *</span>
                </div>
            </div>
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md">
                    <input type="text" placeholder="" />
                    <span class="def-input__label">Телефон *</span>
                </div>
            </div>
        </div>
        <button class="def-button def-button--primary def-button--md width-percent-full">Продолжить</button>
    </form>
</div>
@endsection
