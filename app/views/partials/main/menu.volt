<div class="container b-header__box b-relative" style="
    width: 1200px;
    height: 89px;
">
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
                            <li class="b-top-nav__2level_title f-top-nav__2level_title">Móc Khóa</li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="our_gallery_2_colums.html"><i class="fa fa-angle-right"></i>Móc Khóa Mica</a></li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="our_gallery_3_colums.html"><i class="fa fa-angle-right"></i>Móc Khóa Gương soi</a></li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="our_gallery_4_colums.html"><i class="fa fa-angle-right"></i>Móc Khóa Khưi bia</a></li>
                        </ul>
                        <ul class="b-top-nav__2level_wrap">
                            <li class="b-top-nav__2level_title f-top-nav__2level_title">Huy Hiệu</li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="our_gallery_4_colums.html"><i class="fa fa-angle-right"></i>Móc Khóa Khưi bia</a></li>
                        </ul>
                        <ul class="b-top-nav__2level_wrap">
                            <li class="b-top-nav__2level_title f-top-nav__2level_title">Ly Sứ</li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="about_us_pricing.html"><i class="fa fa-angle-right"></i>Ly Loại Thường</a></li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="about_us_version_1.html"><i class="fa fa-angle-right"></i>Ly Sứ Thái</a></li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="about_us_version_2.html"><i class="fa fa-angle-right"></i>Ly Sứ Minh Long</a></li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="about_us_version_3.html"><i class="fa fa-angle-right"></i>Ly Loại Huyền Ảo</a></li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="about_us_faqs_page.html"><i class="fa fa-angle-right"></i>Ly Cặp</a></li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="about_us_meet_our_team.html"><i class="fa fa-angle-right"></i>Ly Có Muỗng</a></li>
                        </ul>
                        <ul class="b-top-nav__2level_wrap">
                            <li class="b-top-nav__2level_title f-top-nav__2level_title">Dồng Hồ</li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="extra_pages_coming_soon.html"><i class="fa fa-angle-right"></i>Hình Vuông</a></li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="extra_pages_coming_soon_v2.html"><i class="fa fa-angle-right"></i>HÌnh Chữ Nhật</a></li>
                        </ul>
                        <ul class="b-top-nav__2level_wrap">
                            <li class="b-top-nav__2level_title f-top-nav__2level_title">Ốp Lưng Điện Thoại</li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="page_forgot_username_password.html"><i class="fa fa-angle-right"></i>Sam Sung</a></li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="page_log_in_page.html"><i class="fa fa-angle-right"></i>Sum Sik Bồ Kết</a></li>
                        </ul>
                        <ul class="b-top-nav__2level_wrap">
                            <li class="b-top-nav__2level_title f-top-nav__2level_title">Các Sản Phẩm Khác</li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="page_forgot_username_password.html"><i class="fa fa-angle-right"></i>Bút bi Nhã Nhã</a></li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="page_log_in_page.html"><i class="fa fa-angle-right"></i>BIễu Trưng</a></li>
                            <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="page_log_in_page.html"><i class="fa fa-angle-right"></i>Pha Lê</a></li>
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