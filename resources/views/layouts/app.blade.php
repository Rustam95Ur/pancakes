<!DOCTYPE html>
<html lang="ru" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{Voyager::setting('site.title')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('css/main.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/style-x.css')}}" rel="stylesheet" type="text/css">
    <meta name="theme-color" content="#ffcc00">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500&display=swap&subset=cyrillic"
          rel="stylesheet">
</head>
<body class="page page_index">
@extends('layouts.header')
@yield('content')
{{--@extends('layouts.footer')--}}
<div class="toper">
    <svg class="toper__svg" width="20" height="24">
        <use xlink:href="/images/assets/svg-symbols.svg#arrow-top"></use>
    </svg>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="/js/appInit.js"></script>
<script src="/js/separate-js/jquery.matchHeight-min.js"></script>
<script src="/js/separate-js/slick.min.js"></script>
<script src="/js/separate-js/chosen.jquery.min.js"></script>
<script src="/js/separate-js/jquery.colorbox-min.js"></script>
<script src="/js/main.min.js"></script>
<script src="/js/app.js"></script>
<script>
    $(document).ready(function () {
        var status = 0;
        $('.burger-btn').on('click', function () {
            if (status == 0) {
                $('#header__menu_mobile').addClass('header__mobile_open')
                status = 1
            } else if (status == 1) {
                $('#header__menu_mobile').removeClass('header__mobile_open')
                status = 0
            }
        });
    });
</script>
</body>
</html>
