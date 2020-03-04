<header class="header">
    <div class="header__wrapper">
        <div class="header__logo">
            <a class="logo" href="{{route('home')}}"><span class="logo__img logo__img_pancake"></span></a>
        </div>
        <div class="spacer"></div>
        <div class="header__menu">
            <nav class="menu menu_header menu_top">
                <ul class="menu__list">
                    <li class="menu__item {{Request::route()->getName() == 'menu'  ? 'active' : null }}">
                        <a class="menu__link " href="{{route('menu', 'pancake')}}">
                            <span class="menu__link-block" data-hover="{{trans('header.menu')}}">{{trans('header.menu')}}</span>
                        </a>
                    </li>
                    <li class="menu__item {{Request::is('page/delivery')  ? 'active' : null }}">
                        <a class="menu__link" href="{{route('page','delivery')}}">
                            <span class="menu__link-block" data-hover="{{trans('header.payment')}}">{{trans('header.payment')}}</span>
                        </a>
                    </li>
                    <li class="menu__item {{Request::is('page/action')  ? 'active' : null }}">
                        <a class="menu__link" href="{{{route('page','action')}}}">
                            <span class="menu__link-block" data-hover="{{trans('header.action')}}">{{trans('header.action')}}</span>
                        </a>
                    </li>
                    <li class="menu__item {{Request::route()->getName() == 'contact'  ? 'active' : null }}">
                        <a class="menu__link" href="{{route('contact')}}">
                            <span class="menu__link-block" data-hover="{{trans('header.contact')}}">{{trans('header.contact')}}</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="spacer"></div>
        <div class="header__tel"></div>
        <div class="header__basket">
            <a class="basket-mini" href="/basket"><span class="basket-mini__wrapper"><span class="basket-mini__icon"><svg
                            class="basket-mini__svg icon_basket" width="24" height="21">
        <use xlink:href="/images/assets/svg-symbols.svg#basket"></use></svg></span> <span class="basket-mini__hover"><svg
                            class="basket-mini__svg icon_basket" width="24" height="21">
        <use xlink:href="/images/assets/svg-symbols.svg#basket"></use></svg></span></span> <span
                    class="basket-mini__cost js--basket-header__count" style="display: none;">0</span></a>
        </div>
        <div class="header__mobile-btn">
            <div class="burger-btn" data-toggle="collapse" data-target="#header__menu_mobile">
                <span class="burger-btn__line burger-btn__line_top"></span> <span
                    class="burger-btn__line burger-btn__line_middle"></span> <span
                    class="burger-btn__line burger-btn__line_bottom"></span>
            </div>
        </div>
        <div class="header__mobile" id="header__menu_mobile">
            <nav class="menu menu_header menu_mobile">
                <ul class="menu__list">
                    <li class="menu__item">
                        <a class="menu__link" href="{{route('menu', 'pancake')}}"><span class="menu__link-block"
                                                                       data-hover="{{trans('header.menu')}}">{{trans('header.menu')}}</span></a>
                    </li>
                    <li class="menu__item">
                        <a class="menu__link" href="{{route('page', 'delivery')}}"><span class="menu__link-block"
                                                                     data-hover="{{trans('header.payment')}}">{{trans('header.payment')}}</span></a>
                    </li>
                    <li class="menu__item">
                        <a class="menu__link" href="{{route('page', 'action')}}"><span class="menu__link-block"
                                                                    data-hover="{{trans('header.action')}}">{{trans('header.action')}}</span></a>
                    </li>
                    <li class="menu__item">
                        <a class="menu__link" href="{{route('contact')}}"><span class="menu__link-block" data-hover="{{trans('header.contact')}}">{{trans('header.contact')}}</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>