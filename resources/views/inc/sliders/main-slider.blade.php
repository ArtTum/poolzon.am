<div class="slider simple-slider main-slider relative">
    @foreach($sliders as $slider)
        <div class="main-slider__item bg-cover" style="background-image: url({{ '/uploads/sliders/'.$slider->slider_image }})">
            <div class="main-slider__inner">
                <div class="inner-container">
                    <div class="main-slider__content">
                        <h1 class="font-extra-large font-primary--bold">
                            {{ \App\Http\Helpers\Translate::text($slider->getSliderLang(), 'slider_name') }}
                        </h1>
                        <p class="main-slider__text font-medium">
                            {{ \App\Http\Helpers\Translate::text($slider->getSliderLang(), 'slider_description') }}
                        </p>
                        <a href="{{ \App\Http\Helpers\Helper::lang($slider->url) }}" class="font-medium">
                            {{ \App\Http\Helpers\Translate::text($slider->getSliderLang(), 'slider_button') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
