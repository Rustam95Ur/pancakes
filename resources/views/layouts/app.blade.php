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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body class="page page_index">
@extends('layouts.header')
@yield('content')
@extends('layouts.footer')
@extends('layouts.modal')
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@if ($message = Session::get('success') or $message = Session::get('error') or $message = Session::get('warning') or $message = Session::get('info') or $errors->any())
    <script>
        (function ($) {
            $(function () {
                $('#messageModal').modal('show');
                setTimeout(function () {
                    $('#messageModal').modal('hide')
                }, 4000);
            });
        })(jQuery);
    </script>
@endif
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
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
<script>
    $('.grid').masonry({
        // options
        itemSelector: '.grid-item',
        columnWidth: 50
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".menu__link").on("click", function (event) {
            event.preventDefault();
            console.log('dawda')
            var id  = $(this).attr('href'),
                top = $(id).offset().top;
            $('body,html').animate({scrollTop: top}, 1000);
        });
    });
</script>
</body>
</html>
