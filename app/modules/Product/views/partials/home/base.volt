<div class="l-main-container">
    <section class="b-infoblock b-diagonal-line-bg-light">
        <div class="container">
            <!-- Begin row catolog -->

            {% for type in types %}
                <!-- Start catolog-->
                {% set temp = loop.revindex + 1%}
                {% if (temp  % 2) == 0 %}
                    <div class="row b-col-default-indent">
                {% endif %}
                <div class="col-md-6">
                    <div class="b-news-item b-news-item--medium-size f-news-item">
                        <div class="b-news-item__img view view-sixth">
                            {% set img = helper.image([
                            'type': 'product',
                            'id': 1,
                            'width': 1200,
                            'strategy': 'w'
                            ]) %}
                            {{ img.imageHTML() }}

                            <div class="b-item-hover-action f-center mask">
                                <div class="b-item-hover-action__inner">
                                    <div class="b-item-hover-action__inner-btn_group">
                                        <a href="#" class="b-btn f-btn b-btn-light f-btn-light info">Đặt hàng <i
                                                    class="fa fa-shopping-cart"></i></a>
                                        <a href="shop_detail.html" class="b-btn f-btn b-btn-light f-btn-light info">Tổng
                                            quát <i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="b-news-item__info">
                            <a href="shop_detail.html"
                               class="b-news-item__info_title-big f-news-item__info_title-big f-primary-b">{{ type.getTitle() }}</a>

                            <div class="b-blog-short-post b-blog-short-post__item row">
                                {% for product in type.products %}
                                    <div class="b-blog-short-post__item col-md-12 col-sm-4 col-xs-12 f-primary-b">
                                        <div class="b-blog-short-post__item_text f-blog-short-post__item_text">
                                            <a href="{{ helper.langUrl(['for':'product','type':type.getSlug(),'slug':product.getSlug()]) }}">{{ product.getTitle() }}</a>
                                        </div>
                                    </div>
                                {% endfor %}
                            </div>
                            <div class="b-news-item__article b-color-picker b-news___color-picker f-news___color-picker f-uppercase">
                                <a href="#" class="f-more right">Tổng quát</a>
                            </div>
                        </div>
                    </div>
                </div>
                {% if not ((temp  % 2) == 0 ) %}
                    </div>
                {% endif %}
                <!--- End catolog -->
            {% endfor %}
            <!-- End row catolog -->
        </div>
    </section>
</div>