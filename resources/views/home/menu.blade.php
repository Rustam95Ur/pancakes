@extends('layouts.app')
@section('content')
    <main class="main-container" role="main">
        <div class="product-menu">
            <ul class="product-menu__list">
                @foreach($categories as $category)
                    <li class="product-menu__item {{($category->slug == $slug) ? 'active': null }}">
                        <a class="product-menu__link" href="{{route('menu', $category->slug)}}">
                            <span class="product-menu__link-block"
                                  data-hover="{{$category->name}}">{{$category->name}}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="container container_fluid">
            <div class="row no-gutters">
                <div class="col-12 col-sm-6 col-lg-4 col-xxl-3">
                    @foreach($products as $product)
                        <div class="product-unit">
                            <div class="product-unit__img">
                                <img class="product-unit__img-src" src="{{Voyager::image($product->image)}}" alt=""  role="presentation">
                            </div>

                            <div class="product-unit__wrapper">
                                <div class="product-unit__title"> {{$product->title}}</div>
                                <div class="product-unit__info"> {!! $product->description !!}</div>
                            </div>
                            <div class="product-unit__spacer">
                            </div>
                            <div class="product-unit__footer">
                                <div class="product-unit__price"> {{$product->price}}
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
                                                <div class="basket-mini__icon-plus">+
                                                </div>
                                            </div>
                                        </div>
                                        <span class="basket-mini__cost js--basket-product__count"
                                              style="display: none;">
				0				</span>
                                    </div>
                                </div>
                                <div class="product-unit__weight">{{$product->weight}}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection

