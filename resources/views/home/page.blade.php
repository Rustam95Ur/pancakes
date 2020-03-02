@extends('layouts.app')
@section('content')
    <main class="main-container" role="main">
        <div class="page-header">
            <h1 class="page-header__title">{{$page->title}}</h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="info-block text-center">
                        <img src="{{Voyager::image($page->image)}}" alt="{{$page->title}}" class="page-image">
                        <div class="info-block__info ">
                            <div class="row row_mb60 justify-content-between">
                                <div class="col-md-12 col-sm-12">
                                    {!! $page->body !!}
                                    <div class="col-md-6 col-sm-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
