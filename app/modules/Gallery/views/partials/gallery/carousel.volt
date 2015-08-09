{% set images = gallery.cachedImages() %}
<div id="myCarousel" class="carousel slide">
    <!-- Carousel items -->
    <div class="carousel-inner">
        {% for key,image in images %}
            {% set img = helper.image([
            'type': 'gallery',
            'id': image.getId(),
            'width': 1200,
            'strategy': 'w',
            'widthHeight': false
            ]) %}
            <div class="item {% if key == 0 %}active {% endif %}">
                <img src="{{ img.cachedRelPath() }}" alt="">
                <div class="carousel-caption">
                    <p>{{ image.getCaption() }}</p>
                </div>
            </div>
        {% endfor %}
    </div>
    <!-- Carousel nav -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
        <i class="fa fa-angle-left"></i>
    </a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">
        <i class="fa fa-angle-right"></i>
    </a>
</div>