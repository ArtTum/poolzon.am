<div class="slider simple-slider adds-slider relative">
    @foreach($banners as $banner)
        <div class="adds-slider__item bg-cover"
             style="background-image: url({{ '/uploads/banners/'.$banner->banner_image }})"></div>
    @endforeach
</div>
