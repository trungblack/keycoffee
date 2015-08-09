{% set images = gallery.cachedImages() %}

    {% for image in images %}
    <li>
    {% set img = helper.image([
        'type': 'gallery',
        'id': image.getId(),
        'width': 200,
        'strategy': 'w'

    ]) %}
    {{ img.imageHTML() }}
    </li>
    {% endfor %}