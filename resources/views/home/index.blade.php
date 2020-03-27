@extends('layouts.app')
@section('content')
    <main class="main-container" role="main">
        <main class="main-container" role="main">
            <div class="container_fluid container_bg">
                <div class="row no-gutters container_bg_color">
                    <div class="col-xl-12">
                        <div class="slider">
                            <div class="slider__item">
                                <span class="slider-unit__img slider-unit__img_noretina"></span>
                                <span class="slider-unit__img slider-unit__img_retina"></span>
                                <span class="slider-unit__info">
                                    <h1 class="slider_main_text custom_font">Lit Crepes</h1>
                                    <span class="slider-unit__title">
                                        <img src="{{asset('images/slogan.png')}}">
                                    </span>
                                    <span class="slider-unit__subtitle">Food trailer that serves delicious <br>stuffed european style CREPES of Your choice </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="recommendation" id="menu">
                <div class="recommendation__header row">
                    <div class="col-12 col-sm-12 text-center">
                        <div class="recommendation__title custom_font">
                            {{trans('page.home.new')}}
                        </div>
                    </div>
                </div>
                <div class="recommendation__slider no-gutters" >
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
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            <section class="reviews" id="reviews">
                <div class="recommendation__header row">
                    <div class="col-12 col-sm-12 text-center">
                        <div class="recommendation__title custom_font">
                            {{trans('page.home.reviews')}}
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row grid">
                        @foreach($comments as $comment)
                            <div class="grid-item">
                                <div class="comment_block">
                                    @if ($comment->type == 1)
                                        <p class="comment_type text-success">Good</p>
                                    @else
                                        <p class="comment_type text-danger">Bad</p>
                                    @endif
                                    <h2 class="text-danger text-bold comment_author">{{$comment->name}}</h2>
                                    <p class="comment_message  text-dark">{{$comment->message}} </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-12">
                        <form method="post" action="{{route('save-comment')}}">
                            @csrf
                            <div class="comment_block">
                                <h2 class="text-danger text-bold comment_author">Leave your review</h2>
                                <h3 class="text-danger text-bold">We will be grateful to you</h3>
                                <input class="form-control" name="name" placeholder="Write your name" required>
                                <textarea name="message" placeholder="Write your review" class="form-control"
                                          rows="5" required></textarea>
                                <div class="form-group">
                                    <input type="radio" id="good" name="type" value="1" required>
                                    <label for="good" class="text-dark">Good review</label>
                                    <input type="radio" id="bad" name="type" value="0">
                                    <label for="bad" class="text-dark">Bad review</label>
                                </div>
                                <button class="btn btn-danger" type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </main>
    <section id="contact">
        <div class="recommendation__header row">
            <div class="col-12 col-sm-12 text-center">
                <div class="recommendation__title custom_font">
                    {{trans('page.home.contact')}}
                </div>
            </div>
        </div>
        <div class="map-block">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3446.5206248564004!2d-97.75646998447864!3d30.25074398180767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8644b5d05ff14a83%3A0xd534ee3eada9f293!2s1311%20S.%201st%20St.%20Park%2C%20Ira%20and%20Bev&#39;s!5e0!3m2!1sru!2skz!4v1583124153853!5m2!1sru!2skz"
                width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
    </section>
@endsection
