<div class="product-items-menu">
    {% for type in types %}
        {#<li><a href="{{ helper.langUrl(['for':'product','type':'coffee','slug':product.getSlug()]) }}">{{ product.getTitle() }}</a></li>#}
        <div class="product-menu-item col-md-{{cols}}">
            <p class="product-menu-title">{{ type.getTitle() }}</p>
            {% for product in type.products %}
                <ul class="list-group">
                    <li class="list-group-item" ><a  href=" {{ helper.langUrl(['for':'product','type':type.getSlug(),'slug':product.getSlug()]) }}">{{ product.getTitle() }}</a></li>
                </ul>
            {% endfor %}
        </div>
    {% endfor %}
</div>
