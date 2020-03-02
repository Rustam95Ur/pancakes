@extends('layouts.app')
@section('content')
    <main class="main-container" role="main">
        <main class="main-container" role="main">
            <div class="container container_fluid container_bg">
                <div class="row no-gutters">
                    <div class="col-xl-8">
                        <div class="slider">
                            <div class="slider__item">
                                <span class="slider-unit__img slider-unit__img_noretina"></span>
                                <span class="slider-unit__img slider-unit__img_retina"></span>
                                <span class="slider-unit__info"><span class="slider-unit__title"><img
                                            src="{{asset('images/slogan.png')}}"></span>
                                        <span class="slider-unit__subtitle">Food trailer that serves delicious <br>stuffed european style CREPES of Your choice </span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <nav class="menu-block menu-block_pancake">
                            <ul class="menu-block__list">
                                <li class="menu-block__item">
                                    <a class="menu-block__link" href="/menu/bliny"><span class="menu-block__icon"><svg
                                                class="menu-block__svg" width="64" height="66">
                  <use xlink:href="/images/assets/svg-symbols.svg#pancake"></use></svg></span> <span
                                            class="menu-block__title">Блины</span></a>
                                </li>
                                <li class="menu-block__item">
                                    <a class="menu-block__link" href="/menu/soups"><span class="menu-block__icon"><svg
                                                class="menu-block__svg" width="64" height="66">
                  <use xlink:href="/images/assets/svg-symbols.svg#soup"></use></svg></span> <span
                                            class="menu-block__title">Салаты, супы</span></a>
                                </li>
                                <li class="menu-block__item">
                                    <a class="menu-block__link" href="/menu/porridges"><span class="menu-block__icon"><svg
                                                class="menu-block__svg" width="64" height="66">
                  <use xlink:href="/images/assets/svg-symbols.svg#porridge"></use></svg></span> <span
                                            class="menu-block__title">Каши</span></a>
                                </li>
                                <li class="menu-block__item">
                                    <a class="menu-block__link" href="/menu/dobavki"><span class="menu-block__icon"><svg
                                                class="menu-block__svg" width="64" height="66">
                  <use xlink:href="/images/assets/svg-symbols.svg#salad"></use></svg></span> <span
                                            class="menu-block__title">Добавки</span></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="recommendation">
                <div class="recommendation__header row">
                    <div class="col-12 col-sm-12 text-center">
                        <div class="recommendation__title">
                            {{trans('page.home.new')}}
                        </div>
                    </div>
                </div>
                <div class="recommendation__slider no-gutters">
                    @foreach($products as $product)
                        <div class="recommendation__item">
                            <div class="product-unit" id="cu45" data-id="45">
                                <div class="product-unit__img"><img
                                        class="product-unit__img-src product-unit__img-src_noretina"
                                        src="{{Voyager::image($product->image)}}" alt="" role="presentation">
                                </div>
                                <div class="product-unit__wrapper">
                                    <div class="product-unit__title">
                                        {{$product->title}}
                                    </div>
                                    <div class="product-unit__info">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                                <div class="product-unit__spacer"></div>
                                <div class="product-unit__footer">
                                    <div class="product-unit__price">
                                        {{$product->price}}
                                        <div class="product-unit__price-ruble">
                                            $
                                        </div>
                                    </div>
                                    <div class="product-unit__basket">
                                        <div class="basket-mini basket-mini_yellow">
                                            <div class="basket-mini__wrapper js--add-to-basket__btn">
                                                <div class="basket-mini__icon">
                                                    <svg class="basket-mini__svg icon_basket js--basket-product__icon"
                                                         width="24" height="21">
                                                        <use xlink:href="/images/assets/svg-symbols.svg#basket"></use>
                                                    </svg>
                                                </div>
                                                <div class="basket-mini__icon-hover js--basket-product__plus">
                                                    <div class="basket-mini__icon-plus">
                                                        +
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="basket-mini__cost js--basket-product__count"
                                                  style="display: none;">0</span>
                                        </div>
                                    </div>
                                    <div class="product-unit__weight">
                                        {{$product->weight}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
    </main>
        <div class="map-block">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3446.5206248564004!2d-97.75646998447864!3d30.25074398180767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8644b5d05ff14a83%3A0xd534ee3eada9f293!2s1311%20S.%201st%20St.%20Park%2C%20Ira%20and%20Bev&#39;s!5e0!3m2!1sru!2skz!4v1583124153853!5m2!1sru!2skz"
                width="1920" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
@endsection
