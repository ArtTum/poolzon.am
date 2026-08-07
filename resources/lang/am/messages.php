<?php

$arr = [];
$langs = \App\Models\Translate::all();

foreach ($langs as $lang){
    $arr[$lang->key] = $lang->lang[0]->text;
}
return $arr;
