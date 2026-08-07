<?php
$version = "?version=1.1"
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>poolzon.am</title>
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/fonts/icomoon/style.css{{ $version }}" type="text/css">
    <link rel="stylesheet" href="/css/global.css{{ $version }}" type="text/css">
    <meta name="mailru-domain" content="gaHJH950RZnEPsYA" />
    <link rel="stylesheet" type="text/css" href="/libs/slick/slick.css{{ $version }}"/>
    <link rel="stylesheet" href="https://unpkg.com/smartphoto@1.1.0/css/smartphoto.min.css">
    <link rel="stylesheet" href="/css/jquery-ui.css{{ $version }}" type="text/css" media="all" />
    <script src="/js/jquery.min.js{{ $version }}" type="text/javascript"></script>
    <script src="/js/jquery-ui.min.js{{ $version }}" type="text/javascript"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="/js/price-rang.js{{ $version }}"></script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(91126922, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/91126922" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <script src="https://unpkg.com/smartphoto@1.1.0/js/smartphoto.min.js"></script>
<!-- /Yandex.Metrika counter -->
</head>
<body id="body" class=""><!-- TODO  add class 'order-page' for order pages-->
<div class="page-container">
    @include('layouts.header')
    @yield('content')
</div>

@include('layouts.footer')
@include('inc.modals.modal')


<script src="/js/main.js{{ $version }}"></script>
<script src="/js/selectbox.js{{ $version }}"></script>

<script type="text/javascript" src="/libs/slick/slick.min.js{{ $version }}"></script>
<script src="/js/sliders.js{{ $version }}"></script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-TFM8LCW1KL"></script>
<script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-TFM8LCW1KL'); </script>
</body>
</html>
