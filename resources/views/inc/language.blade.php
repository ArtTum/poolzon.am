<?php

use App\Http\Helpers\Helper;
use App\Models\Lang;
use Illuminate\Support\Facades\App;

$languages = Helper::languageUrl();
$lang_ = Lang::where('iso', App::getLocale())->first();
$iso = ($lang_->iso == 'am') ? '' : $lang_->iso . '/';
?>

@if(isset($languages))
    <span class="language-box" id="langBox">
        <span class="language-box__selected-item hide-for-sm-mobile" onclick="toggleBoxes('langList', 'langBox')">
            {{ $lang_->iso }}
        </span>
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
