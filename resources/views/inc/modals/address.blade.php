<div class="modal fade" id="addressModal">
    <div class="modal__dialog small address-modal">
        <span class="modal__close" onclick="closeModal('addressModal')"><i class="icon-close"></i></span>
        <!-- Modal content-->
        <div class="modal__content">
            <p class="font-medium font-primary--bold margin-bottom-large">{{ __('messages.Выбрать регион') }}</p>
            <form>
                <div class="margin-bottom-medium">
                    <p class="margin-bottom-small-xs text-transform--capitalize">{{ __('messages.регион') }} <sup>*</sup></p>
                    <div class="def-input">
                        <input type="text"/>
                    </div>
                </div>
                <button class="def-button def-button--primary width-percent-full">{{ __('messages.Сохранить') }}</button>
            </form>

        </div>
    </div>
</div>
