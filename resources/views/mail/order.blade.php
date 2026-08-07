<?php
/**
 * Created by PhpStorm.
 * User: artur999
 * Date: 11/15/2018
 * Time: 11:48 PM
 */
?>

<?php
/**
 * Created by PhpStorm.
 * User: artur999
 * Date: 11/15/2018
 * Time: 9:30 AM
 */
?>
<div>
    <div>
        <div id="m_8275075430624136167style_15708190821267118833_BODY">
            <div>
                <div class="flex-table__row flex">
                    <div class="flex-table__column"><span>{{ __('messages.Способ оплаты') }}</span></div>
                    <b class="flex-table__column"><span>{{ $order->type == 1 ? __('messages.Картой онлайн') : __('messages.Оплата наличными')  }}</span></b>
                </div>
                <h1 class="title--primary font-large-xs font-primary--medium margin-bottom-small">{{ __('messages.Ваши данные') }}</h1>
                <div class="flex-table__row flex">
                    <div class="flex-table__column"><span>{{ __('messages.Емайл *') }}</span></div>
                    <b class="flex-table__column"><span>{{ $order->email }}</span></b>
                </div>
                <div class="flex-table__row flex">
                    <div class="flex-table__column"><span>{{ __('messages.Имя *') }}</span></div>
                    <b class="flex-table__column"><span>{{ $order->first_name }}</span></b>
                </div>
                <div class="flex-table__row flex">
                    <div class="flex-table__column"><span>{{ __('messages.Имя *') }}</span></div>
                    <b class="flex-table__column"><span>{{ $order->first_name }}</span></b>
                </div>
                <div class="flex-table__row flex">
                    <div class="flex-table__column"><span>{{ __('messages.Фамилия *') }}</span></div>
                    <b class="flex-table__column"><span>{{ $order->last_name }}</span></b>
                </div>
                <div class="flex-table__row flex">
                    <div class="flex-table__column"><span>{{ __('messages.Телефон *') }}</span></div>
                    <b class="flex-table__column"><span>{{ $order->phone }}</span></b>
                </div>
                <h1 class="title--primary font-large-xs font-primary--medium margin-bottom-small">{{ __('messages.Данные получателя *') }}</h1>
                <div class="flex-table__row flex">
                    <div class="flex-table__column"><span>{{ __('messages.Имя *') }}</span></div>
                    <b class="flex-table__column"><span>{{ $order->p_first_name }}</span></b>
                </div>
                <div class="flex-table__row flex">
                    <div class="flex-table__column"><span>{{ __('messages.Фамилия *') }}</span></div>
                    <b class="flex-table__column"><span>{{ $order->p_last_name }}</span></b>
                </div>
                <div class="flex-table__row flex">
                    <div class="flex-table__column"><span>{{ __('messages.Телефон *') }}</span></div>
                    <b class="flex-table__column"><span>{{ $order->p_phone }}</span></b>
                </div>
                <hr>
                <div class="flex-table__row flex">
                    <div class="flex-table__column"><span>{{ __('messages.Город , Улица') }}</span></div>
                    <b class="flex-table__column"><span>{{ $order->address }}</span></b>
                </div>
                <div class="flex-table__row flex">
                    <div class="flex-table__column"><span>{{ __('messages.Квартира / Дом') }}</span></div>
                    <b class="flex-table__column"><span>{{ $order->home }}</span></b>
                </div>
                <div class="flex-table__row flex">
                    <div class="flex-table__column"><span>{{ __('messages.Подъезд') }}</span></div>
                    <b class="flex-table__column"><span>{{ $order->entrance }}</span></b>
                </div>
                <div class="flex-table__row flex">
                    <div class="flex-table__column"><span>{{ __('messages.Этаж') }}</span></div>
                    <b class="flex-table__column"><span>{{ $order->floor }}</span></b>
                </div>
                <div class="flex-table__row flex">
                    <div class="flex-table__column"><span>{{ __('messages.Домофон') }}</span></div>
                    <b class="flex-table__column"><span>{{ $order->intercom }}</span></b>
                </div>
                <div class="flex-table__row flex">
                    <div class="flex-table__column"><span>{{ __('messages.Комментарии') }}</span></div>
                    <b class="flex-table__column"><span>{{ $order->comment }}</span></b>
                </div>
                <br>
                <table style="background:#ffffff;color:#000000;font:400 12px/22px Arial,Helvetica,sans-serif"
                       width="100%" cellspacing="0" cellpadding="0">
                </table>
                <div style="font:700 36px/36px Helvetica,Arial,sans-serif;color:black; text-align: center">
                    Ձեր՝ N {{ $order->id }} պատվերը ընդունված է։
                </div>
                <br>
                <div style="font:400 16px/24px Helvetica,Arial,sans-serif;color:#000000">
                    Շնորհակալություն մեր ընկերության հետ կապվելու համար:<br>
                    Մոտ ժամանակներս մեր մենեջերը կկապվի ձեզ հետ:
                </div>
                <table style="margin:auto;width:700px" cellspacing="0" cellpadding="0">
                    <tbody>
                    @foreach(unserialize($order->products) as $item)
                    <tr>
                        <td style="padding:10px 5px;border-top:1px solid #eaeaea" width="50"
                            valign="center">
                            <a href="cartcart"
                               class="flex-table__column flex-table__column--small-xs">
                               <img width="200px" src="https://poolzon.am/{{ $item->attributes->image }}">
                            </a>
                        </td>
                        <td style="padding:10px 0;border-top:1px solid #eaeaea" width="220"
                            valign="center">
                            <p><span
                                    class="font-primary--medium">{{ \App\Http\Helpers\Translate::text(\App\Models\Product::find($item->id)->lang(), 'product_name') }}</span>
                            </p>
                        </td>

                        <td style="padding:10px;border-top:1px solid #eaeaea" valign="center"
                            align="center">
                            <div class="price price--sm">
                                @if(\App\Models\Product::find($item->id)->sale)
                                    <span class="price__actual no-wrap color-pink">{{ number_format(\App\Models\Product::find($item->id)->price - (\App\Models\Product::find($item->id)->price * \App\Models\Product::find($item->id)->sale / 100)) }}<span
                                            class="price__icon"><i
                                                class="icon-dram"></i></span></span>
                                    <span class="price__discount no-wrap">{{ number_format(\App\Models\Product::find($item->id)->price) }}<span
                                            class="price__icon"><i
                                                class="icon-dram"></i></span>
                                                        </span>
                                @else
                                    <span class="price__actual no-wrap">{{ number_format(\App\Models\Product::find($item->id)->price) }}<span
                                            class="price__icon"><i
                                                class="icon-dram"></i></span></span>

                                @endif
                                դրամ
                            </div>
                        </td>
                        <td style="padding:10px;border-top:1px solid #eaeaea" valign="center">
                            {{ $item->quantity }} {{ __('messages.шт') }}
                        </td>
                        <td style="padding:10px;border-top:1px solid #eaeaea;text-align:right;padding-right:20px" valign="center" align="center">

                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="block-container cart-container__order order-box">
                    <div class="block-container__inner">
                        <div class="flex align-items--center justify--space-between order-box__row">
                                    <span
                                        class="order-box__col font-medium font-primary--medium">{{ __('messages.Ваша корзина') }}</span>
                            <span
                                class="text-right order-box__count"><span class="total-count">{{ $order->total_count }}</span>  {{ __('messages.товара') }}</span>
                        </div>
                        <div class="flex align-items--center justify--space-between order-box__row">
                            <span class="order-box__col">{{ __('messages.Доставка') }} </span>
                            <span class="text-right font-primary--medium font-standard no-wrap">
                                 3900<span class="font-small margin-left-small-xs">Դրամ</span>
                            </span>
                        </div>
                        <div class="flex align-items--center justify--space-between order-box__row border border--top">
                            <span class="order-box__col font-medium font-primary--medium">{{ __('messages.Общая стоимость') }}</span>
                            <span class="text-right font-standard price">
                               <span class="price__actual no-wrap"><span class="total-price">{{ number_format($order->total_price+ 3900) }}</span><span class="price__icon">Դրամ</span></span>
                            </span>
                        </div>
                    </div>
                </div>
                <p>
                    Շնորհակալություն գնումների համար
                </p>
            </div>
        </div>
    </div>
</div>
