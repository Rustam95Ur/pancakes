@extends('layouts.app')
@section('content')
    <main class="main-container" role="main">
        <div class="page-header">
            <h1 class="page-header__title">Contact</h1>
        </div>
        <div class="container container_small">
            <form id="hotline-form" class="form-group form-group_animate"  method="post">
               @csrf
                <div class="form-order form-order_hotline" id="hotline">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-order__row">
                                <div class="form-group field-hotlineform-name required">
                                    <div class="form-group__wrapper"><label class="form-group__label"
                                                                            for="hotlineform-name">Name*</label><input
                                            type="text" id="hotlineform-name" class="form-control"
                                            name="HotlineForm[name]" aria-required="true"></div>
                                    <div class="form-group__error"></div>
                                </div>
                            </div>
                            <div class="form-order__row">
                                <div class="form-group field-hotlineform-phone_mail required">
                                    <div class="form-group__wrapper"><label class="form-group__label"
                                                                            for="hotlineform-phone_mail">E-mail*</label><input
                                            type="text" id="hotlineform-phone_mail" class="form-control"
                                            name="HotlineForm[phone_mail]" aria-required="true"></div>
                                    <div class="form-group__error"></div>
                                </div>
                            </div>
                            <div class="form-order__row">
                                <div class="form-group field-hotlineform-message required">
                                    <div class="form-group__wrapper"><label class="form-group__label"
                                                                            for="hotlineform-message">Message*</label><textarea
                                            id="hotlineform-message" class="form-control form-control_textarea"
                                            name="HotlineForm[message]" aria-required="true"></textarea></div>
                                    <div class="form-group__error"></div>
                                </div>
                            </div>
                            <div class="form-order__btn">
                                <button type="submit" class="btn btn_deep-red" data-hover="Send"><span
                                        class="btn__text" data-hover="Send">Send</span></button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
