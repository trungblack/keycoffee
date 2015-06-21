


<div class="b-footer-primary">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-12 f-copyright b-copyright">C O P Y R I G H T  © 2 0 1 5  NGUYENHUNG & NGUYENTRUNG </div>
            <div class="col-sm-8 col-xs-12">
                <div class="b-btn f-btn b-btn-default b-right b-footer__btn_up f-footer__btn_up j-footer__btn_up">
                    <i class="fa fa-chevron-up"></i>
                </div>
                <nav class="b-bottom-nav f-bottom-nav b-right hidden-xs">
                    <ul>
                        <li class=""><a href="sub_catolog.html.html">Cửa hàng</a></li>
                        <li><a href="">Đặt hàng</a></li>
                        <li><a href="">Thắc mắc & liên hệ</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="b-footer-secondary row">
        <div class="col-md-3 col-sm-12 col-xs-12 f-center b-footer-logo-containter">
            <a href=""><img data-retina class="b-footer-logo color-theme" width="150" height="150" src="vendor/theme/img/mockhoa/LoGoNhaNha.jpg" alt="Logo"/></a>
            <div class="b-footer-logo-text f-footer-logo-text">
                <p> Huy HIệu Móc Khóa Nhã Nhã. Bạn Cứ Việc Đưa Hình - Thiết Kế Đã Có Shop Lô</p>
                <div class="b-btn-group-hor f-btn-group-hor">
                    <a href="{{ helper.staticWidget('facebook') }}" class="b-btn-group-hor__item f-btn-group-hor__item" target="_blank">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="{{ helper.staticWidget('googleplus') }}" class="b-btn-group-hor__item f-btn-group-hor__item" target="_blank">
                        <i class="fa fa-google-plus"></i>
                    </a>
                    <a href="#" class="b-btn-group-hor__item f-btn-group-hor__item">
                        <i class="fa fa-twitter"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="b-form-group col-xs-12 col-sm-6 col-md-3">
            <h4 class="f-primary-b">Hãy Góp Ý Cho Chúng Tôi Nếu Bạn Có Thắc Mắc</h4>
            <div class="b-form-row">
                <input type="text" class="form-control" placeholder="Mail Của Bạn" />
            </div>
            <div class="b-form-row">
                <input type="text" class="form-control" placeholder="Chủ Đề" />
            </div>
            <div class="b-form-row">
                <textarea class="form-control" placeholder="Điều Bạn Muốn Nói" rows="5"></textarea>
            </div>
            <div class="b-form-row">
                <a href="#" class="b-btn f-btn b-btn-md b-btn-default f-primary-b b-btn__w100">Gửi Tin Nhắn</a>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <h4 class="f-primary-b">Thông Tin Liên Hệ</h4>
            <div class="b-contacts-short-item-group">
                <div class="b-contacts-short-item col-md-12 col-sm-4 col-xs-12">
                    <div class="b-contacts-short-item__icon f-contacts-short-item__icon f-contacts-short-item__icon_lg b-left">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="b-remaining f-contacts-short-item__text">
                       <span>{{ helper.staticWidget('footer_address') }}</span>
                    </div>
                </div>
                <div class="b-contacts-short-item col-md-12 col-sm-4 col-xs-12">
                    <div class="b-contacts-short-item__icon f-contacts-short-item__icon b-left f-contacts-short-item__icon_md">
                        <i class="fa fa-skype"></i>
                    </div>
                    <div class="b-remaining f-contacts-short-item__text f-contacts-short-item__text_phone">
                        <span>{{ helper.staticWidget('pre_header-skype') }}</span>
                    </div>
                </div>
                <div class="b-contacts-short-item col-md-12 col-sm-4 col-xs-12">
                    <div class="b-contacts-short-item__icon f-contacts-short-item__icon b-left f-contacts-short-item__icon_xs">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="b-remaining f-contacts-short-item__text f-contacts-short-item__text_email">
                        <a href="#"><span>{{ helper.staticWidget('pre_header-email') }}</span></a>
                    </div>
                </div>
                <div class="b-contacts-short-item col-md-12 col-sm-4 col-xs-12">
                    <div class="b-contacts-short-item__icon f-contacts-short-item__icon b-left f-contacts-short-item__icon_xs">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="b-remaining f-contacts-short-item__text f-contacts-short-item__text_email">
                        <span>{{ helper.staticWidget('pre_header-phone') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12 ">
            <h4 class="f-primary-b">Mạng xã hội</h4>
            <div class="b-short-photo-items-group">


                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s); js.id = id;
                            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.3&appId=1495110507438039";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-page" data-href="{{ helper.staticWidget('facebook') }}" data-height="200" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
                        <div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/facebook">
                                <a href="{{ helper.staticWidget('facebook') }}">In Hình Nhã Nhã</a>
                            </blockquote>
                        </div>
                    </div>


            </div>
        </div>
    </div>
</div>
