@extends('layouts.main')
@section('step', 'none')
@section('content')
<div class="order-container max-width-large">
    <div class="order-container__logo logo text-center">
        <img src="/images/logo.svg" alt="logo" />
    </div>
    <form method="post"  action="{{ '/order-one/'.App::getLocale() }}" enctype="multipart/form-data">
        @csrf
        <h1 class="title--primary font-large-xs font-primary--medium margin-bottom-small">{{ __('messages.Ваши данные') }}</h1>
        <p class="sub-title margin-bottom-medium">{{ __('messages.Данные для оформления заказа') }}</p>
        <div class="form margin-bottom-large-xs">

            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md {{ $errors->has('email') ? 'has-danger' : '' }}">
                    <input type="text" placeholder="" name="email" value="{{ old('email') ?? ($one['email'] ?? '') }}" />
                    <span class="def-input__label">{{ __('messages.Емайл *') }}</span>
                </div>
                @if ($errors->has('email'))
                    <div class="form-control-feedback ">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md {{ $errors->has('first_name') ? 'has-danger' : '' }}">
                    <input type="text" placeholder="" name="first_name" value="{{ old('first_name') ?? ($one['first_name'] ?? '')  }}" />
                    <span class="def-input__label">{{ __('messages.Имя *') }}</span>
                </div>
                @if ($errors->has('first_name'))
                    <div class="form-control-feedback ">{{ $errors->first('first_name') }}</div>
                @endif
            </div>
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md {{ $errors->has('last_name') ? 'has-danger' : '' }}">
                    <input type="text" placeholder=""  name="last_name" value="{{ old('last_name')?? ($one['last_name'] ?? '')  }}" />
                    <span class="def-input__label">{{ __('messages.Фамилия *') }}</span>
                </div>
                @if ($errors->has('last_name'))
                    <div class="form-control-feedback ">{{ $errors->first('last_name') }}</div>
                @endif
            </div>
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md {{ $errors->has('phone') ? 'has-danger' : '' }}">
                    <input type="text" placeholder="" name="phone" value="{{ old('phone') ?? ($one['phone'] ?? '')  }}" />
                    <span class="def-input__label">{{ __('messages.Телефон *') }}</span>
                </div>
                @if ($errors->has('phone'))
                    <div class="form-control-feedback ">{{ $errors->first('phone') }}</div>
                @endif
            </div>
        </div>
        <h1 class="title--primary font-large-xs font-primary--medium margin-bottom-small">{{ __('messages.Данные получателя *') }}</h1>
        <div class="form margin-bottom-medium">
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md {{ $errors->has('p_first_name') ? 'has-danger' : '' }}">
                    <input type="text" placeholder="" name="p_first_name" value="{{ old('p_first_name') ?? ($one['p_first_name'] ?? '')  }}" />
                    <span class="def-input__label">{{ __('messages.Имя *') }}</span>
                </div>
                @if ($errors->has('p_first_name'))
                    <div class="form-control-feedback ">{{ $errors->first('p_first_name') }}</div>
                @endif
            </div>
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md {{ $errors->has('p_last_name') ? 'has-danger' : '' }}">
                    <input type="text" placeholder=""  name="p_last_name" value="{{ old('p_last_name') ?? ($one['p_last_name'] ?? '')  }}" />
                    <span class="def-input__label">{{ __('messages.Фамилия *') }}</span>
                </div>
                @if ($errors->has('p_last_name'))
                    <div class="form-control-feedback ">{{ $errors->first('p_last_name') }}</div>
                @endif
            </div>
            <div class="form__row-sm">
                <div class="def-input def-input--secondary def-input--md {{ $errors->has('p_phone') ? 'has-danger' : '' }}">
                    <input type="text" placeholder="" name="p_phone" value="{{ old('p_phone') ?? ($one['p_phone'] ?? '')  }}" />
                    <span class="def-input__label">{{ __('messages.Телефон *') }}</span>
                </div>
                @if ($errors->has('p_phone'))
                    <div class="form-control-feedback ">{{ $errors->first('p_phone') }}</div>
                @endif
            </div>
        </div>
        <button class="def-button def-button--primary def-button--md width-percent-full">{{ __('messages.Продолжить') }}</button>
    </form>
    <br>
    <br>
</div>
@endsection
