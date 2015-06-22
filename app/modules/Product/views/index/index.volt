<div class="container product">
    <div class="row">
        <div class="col-md-3">
            <h4 class="product-type">
                {{ type.getTitle() }}
            </h4>
            <ul class="product-item">
                {% for p in products %}
                    <li class="{% if p.getSlug() == product.getSlug()  %} active {% endif %} module-item-el">
                        <a href="{{ helper.langUrl(['for':'product','type':type.getSlug(),'slug':p.getSlug()]) }}">{{ p.getTitle() }}</a>
                    </li>
                {% endfor %}
            </ul>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5 col-sm-12 product-image">
                    {% set image = helper.image([
                    'id': product.getId(),
                    'type': 'product',
                    'width': 300,
                    'strategy': 'w'
                    ]) %}
                    {{ image.imageHTML() }}
                </div>
                <div class="col-md-7 col-sm-12 product-short-description">
                    <h2>{{ product.getTitle() }}</h2>
                    <h2 class="price">Giá: {{ product.getPrice() }}</h2>
                    <div class="fusion-separator fusion-full-width-sep sep-double"></div>
                    <h3>{{ product.getPackage() }}</h3>
                    <p class="product-short-desc">
                        {{ product.getShort_description() }}
                    </p>

                    <div class="contact-now-btn">
                        <span> Mua Hàng Ngay: </span> {{ helper.widget('product-phone') }}
                    </div>


                </div>
            </div>
            <div class="row">

                <div class="col-md-12 product-desc">
                    <div class="fusion-separator fusion-full-width-sep sep-double"></div>

                    {{ product.getText() }}
                </div>
            </div>
        </div>
    </div>
</div>