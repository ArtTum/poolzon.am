<?php

$arr = [];
$langs = \App\Models\Translate::all();

foreach ($langs as $lang){
    $arr[$lang->key] = $lang->lang[2]->text;
}
return $arr;
