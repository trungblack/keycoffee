
<!--controls-->
<div class="ui segment">

    <a href="/product/admin?lang={{  constant('LANG') }}" class="ui button">
        <i class="icon left arrow"></i> Manage products
    </a>

    <a href="/product/type/add" class="ui button positive">
        <i class="icon plus"></i> Add New
    </a>

</div>
<!--/end controls-->

<table class="ui table very compact celled">
    <thead>
    <tr>
        <th style="width: 100px"></th>
        <th>Title</th>
        <th>URL</th>
        <th>Display Layout</th>
        <th>Thumbnail Inside</th>
    </tr>
    </thead>
    <tbody>
    {% for item in entries %}
        {% set link = "/product/type/edit/" ~ item.getId() %}
        <tr>
            <td><a href="{{  link }}?lang={{  constant('LANG') }}" class="mini ui icon button"><i class="icon edit"></i>
                    id = {{  item.getId() }}</a></td>
            <td><a href="{{  link }}?lang={{  constant('LANG') }}">{{  item.getTitle() }}</a></td>

            {% set pub_link = helper.langUrl(['for':'products', 'type': item.getSlug()]) %}
            <td><a href="{{  pub_link }}" target="_blank">{{  pub_link }}</a></td>
            <td>{{  item.getFormatTitle() }}</td>
            <td>{% if item.getDisplay_date() %}<i class="icon checkmark green"></i>{% endif %}</td>
        </tr>
    {% endfor %}
    </tbody>
</table>
