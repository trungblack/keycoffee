<div class="l-main-container">
    <div class="b-inner-page-header f-inner-page-header">
        <div class="b-inner-page-header__content">
            <div class="container">
                <h1 class="f-primary-l c-default">Thông tin chi tiết</h1>
                <div class="f-primary-l f-inner-page-header_title-add c-senary">Nới tin cậy nhất với khách hàng</div>
            </div>
        </div>
    </div>

    <div class="l-main-container">

        <div class="b-breadcrumbs f-breadcrumbs">
            <div class="container">
                <ul>
                    <li><a href="/"><i class="fa fa-home"></i>Cửa hàng</a></li>
                    <li><i class="fa fa-angle-right"></i><span>Chi tiết</span></li>
                </ul>
            </div>
        </div>

        <!---Detail product -->
        <section class="b-infoblock">
            <div class="container">
                <div class="row">
                    <!-- Begin left --->
                    <div class="col-md-9 ">
                        <div class="b-shortcode-example">

                            <div class="b-product-card b-default-top-indent">
                                <div class="b-product-card__visual-wrap">
                                    <div class="flexslider b-product-card__visual flexslider-zoom">
                                        <ul class="slides">
                                            {{ helper.gallery(product.getGallery_id()) }}

                                        </ul>
                                    </div>
                                    <div class="flexslider flexslider-thumbnail b-product-card__visual-thumb carousel-sm">
                                        <ul class="slides">
                                            {{ helper.gallery(product.getGallery_id()) }}

                                        </ul>
                                    </div>
                                </div>
                                <div class="b-product-card__info">
                                    <div class=" f-primary-b b-title-b-hr f-title-b-hr b-null-top-indent">{{ product.getTitle() }}</div>

                                    <h3 class="f-primary-b b-h4-special f-h4-special">Giá: {{ product.getPrice() }} (Nghìn đồng)</h3>

                                    <div class="b-product-card__info_description f-product-card__info_description">
                                        {{ product.getShort_description() }}
                                    </div>

                                    <div class="b-product-card__info_row">
                                        <div class="b-product-card__info_add b-margin-right-standard">
                                            <div class=" b-btn f-btn b-btn-sm-md f-btn-sm-md">
                                                <i class="fa fa-shopping-cart"></i>Đặt hàng
                                            </div>
                                        </div>
                                    </div>
                                    <div class="b-product-card__info_row" style="padding-left: 15px">
                                        <div class="fb-like" data-href="http://localhost/mockhoaNhaNha/" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="clearfix">
                            <!--Begin Reviews (facebook) -->
                        </div>
                        <div class="b-shortcode-example">
                            <div class="b-tabs f-tabs j-tabs b-tabs-reset">
                                <ul>
                                    <li><a href="#tabs-21">Nhận xét</a></li>
                                </ul>
                                <div class="b-tabs__content">
                                    <div id="tabs-21">
                                        <div class="fb-comments" data-href="{{ helper.langUrl(['for':'product','type':type.getSlug(),'slug':product.getSlug()]) }}" data-width="829" data-numposts="4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Reviews (facebook) -->
                        <div>
                            <h4 class="f-primary-b b-h4-special f-h4-special">Sản phẩm liên quan </h4>
                            <div class="row">
                                <div class="b-col-default-indent">
                                    <div class="col-md-4 col-sm-4 col-xs-6 col-mini-12">
                                        <div class="b-product-preview">
                                            <div class="b-product-preview__img view view-sixth">
                                                <img data-retina src="/vendor/theme/img/shop/shop_1.jpg" alt=""/>
                                                <div class="b-item-hover-action f-center mask">
                                                    <div class="b-item-hover-action__inner">
                                                        <div class="b-item-hover-action__inner-btn_group">
                                                            <a href="#" class="b-btn f-btn b-btn-light f-btn-light info">Dăt Hàng<i class="fa fa-heart"></i></a>
                                                            <a href="#" class="b-btn f-btn b-btn-light f-btn-light info">Chi Tiết<i class="fa fa-shopping-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="b-product-preview__content">
                                                <div class="b-product-preview__content_col">
                                                    <span class="b-product-preview__content_price f-product-preview__content_price f-primary-b">35$</span>
                                                </div>
                                                <div class="b-product-preview__content_col">
                                                    <a href="shop_detail.html" class="f-product-preview__content_title">Skater Dress In Leaf</a>
                                                    <div class="f-product-preview__content_category f-primary-b"><a href="">Women</a> / <a href="">Clothe</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Left --->
                    <!-- Begin right --->
                    <div class="col-md-3">
                        <aside>
                            <div class="row b-col-default-indent">
                                <div class="col-md-12 ">
                                    <div class=" f-primary-b b-title-b-hr f-title-b-hr b-null-top-indent">BẢNG BÁO GIÁ</div>
                                </div>
                                <!---Size 1 -->
                                <div class="col-md-12">
                                    <div class="b-categories-filter">
                                        <h4 class="f-primary-b b-h4-special f-h4-special c-primary">Size 4.4 cm</h4>
                                        <ul>
                                            <li>
                                                <a class="f-categories-filter_name" href="#"><i class="fa fa-plus"></i> Bikini</a>
                                                <span class="b-categories-filter_count f-categories-filter_count">12</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!---Size 2 -->
                                <div class="col-md-12">
                                    <div class="b-categories-filter">
                                        <h4 class="f-primary-b b-h4-special f-h4-special c-primary">Size 4.4 cm</h4>
                                        <ul>
                                            <li>
                                                <a class="f-categories-filter_name" href="#"><i class="fa fa-plus"></i> Bikini</a>
                                                <span class="b-categories-filter_count f-categories-filter_count">12</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!---Size 3 -->
                                <div class="col-md-12">
                                    <div class="b-categories-filter">
                                        <h4 class="f-primary-b b-h4-special f-h4-special c-primary">Size 4.4 cm</h4>
                                        <ul>
                                            <li>
                                                <a class="f-categories-filter_name" href="#"><i class="fa fa-plus"></i> Bikini</a>
                                                <span class="b-categories-filter_count f-categories-filter_count">12</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </aside>

                    </div>
                    <!-- End right --->
                </div>
            </div>
        </section>

    </div>
</div>