<?php
$socials = \App\Models\Social::orderBy('id')->get();
?>
<ul class="social-list inline-elements">
    @foreach($socials as $social)
        <li class="social-list__item">
            <a href="{{ $social->url }}" target="_blank">
                <img width="35px" src="/uploads/socials/{{ $social->icon }}">
            </a>
        </li>
    @endforeach
</ul>