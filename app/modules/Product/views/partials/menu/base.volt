{% for type in types %}
    <ul class="b-top-nav__2level_wrap">
    <li class="b-top-nav__2level_title f-top-nav__2level_title">{{ type.getTitle() }}</li>
    {% for product in type.products %}
        <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="{{ helper.langUrl(['for':'product','type':type.getSlug(),'slug':product.getSlug()]) }}"><i class="fa fa-angle-right"></i>{{ product.getTitle() }}</a></li>
    {% endfor %}
    </ul>
{% endfor %}