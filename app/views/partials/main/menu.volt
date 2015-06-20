<div class="container b-header__box b-relative">
    {# Logo #}
    <a href="/" class="b-left b-logo "><img class="color-theme" data-retina src="vendor/theme/img/logo_web/logo.jpg" alt="Logo" /></a>
    {# Menu #}
    <div class="header-navigation b-header-r b-right b-header-r--icon ">
        <nav class="b-top-nav f-top-nav b-right j-top-nav">
            <ul class="b-top-nav__1level_wrap">
                {# Cửa Hàng#}
                <li class="b-top-nav__1level f-top-nav__1level f-primary-b b-top-nav-big {{ helper.activeMenu().activeClass('index')}}">
                    <a href="{{ helper.langUrl(['for':'index']) }}"><i class="fa fa-cloud-download b-menu-1level-ico"></i>{{ helper.translate('Cửa hàng') }}<span class="b-ico-dropdown"><i class="fa fa-arrow-circle-down"></i></span></a>
                    {# Sub dropdown #}
                    <div class="b-top-nav__dropdomn">
                        <ul class="b-top-nav__2level_wrap">
                            {{ helper.productMenuItems() }}
                        </ul>

                    </div>

                </li>
                {# Đặt Hàng #}
                <li class="b-top-nav__1level f-top-nav__1level  f-primary-b {{ helper.activeMenu().activeClass('products') }}">
                    <a href="{{ helper.langUrl(['for':'products']) }}"><i class="fa fa-cloud-download b-menu-1level-ico"></i>{{ helper.translate('Đặt hàng') }}<span class="b-ico-dropdown"><i class="fa fa-arrow-circle-down"></i></span></a>
                </li>
                {# Liên hệ #}
                <li class="b-top-nav__1level f-top-nav__1level  f-primary-b {{ helper.activeMenu().activeClass('contacts') }}">
                    <a href="{{ helper.langUrl(['for':'contacts']) }}"><i class="fa fa-cloud-download b-menu-1level-ico"></i>{{ helper.translate('Thắc mắc và liên hệ') }}</a>
                </li>
            </ul>

        </nav>
    </div>
</div>