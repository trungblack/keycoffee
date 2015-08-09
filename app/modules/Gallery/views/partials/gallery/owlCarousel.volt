{% set images = gallery.cachedImages() %}
<div class="owl-carousel owl-carousel3">
    {% for key,image in images %}
        {% set img = helper.image([
        'type': 'gallery',
        'id': image.getId(),
        'width': 1000,
        'strategy': 'w',
        'widthHeight': false
        ]) %}
        <div class="recent-work-item">
            <em>
                <img src="{{ img.cachedRelPath() }}" alt="Amazing Project" class="img-responsive" style="width: 273px;height: 162px">
                <a href="{{ image.getLink() }}"><i class="fa fa-link"></i></a>
                <a href="{{ img.cachedRelPath() }}" class="fancybox-button" title="{{ image.getCaption() }}"
                   data-rel="fancybox-button"><i class="fa fa-search"></i></a>
            </em>
            <a class="recent-work-description" href="{{ image.getLink() }}">
                <strong>{{ image.getCaption() }}</strong>
            </a>
        </div>
    {% endfor %}
</div>
