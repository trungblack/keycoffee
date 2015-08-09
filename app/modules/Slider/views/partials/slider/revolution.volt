{% set images = slider.cachedImages() %}

<div class="b-slider j-fullscreenslider ">
    <ul>
        <!-- THE NEW SLIDE -->
        {%  for image in images %}
        {% set img = helper.image([
        'type': 'slider',
        'id': image.getId(),
        'width': 1000,
        'height': 300,
        'strategy': 'a',
        'widthHeight': false
        ]) %}
        <li data-transition="" data-slotamount="7">
            <div class="tp-bannertimer"></div>
            
            {{ img.imageHTML() }}

        </li>
        {% endfor %}
    </ul>
</div>