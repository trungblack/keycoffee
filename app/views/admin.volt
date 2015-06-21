<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ helper.title().append('Administrative Panel') }}{{ helper.title().get() }}</title>

    <link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">

    <link href="/vendor/semantic-1.12.3/semantic.min.css" rel="stylesheet" type="text/css">
    <link href="/vendor/bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/vendor/bootstrap/style_mknn.css" rel="stylesheet" type="text/css">
    <link href="/vendor/bootstrap/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css">

    <!--less-->
    {{ assets.outputLess('modules-admin-less') }}

    <script src="/vendor/js/less-1.7.3.min.js" type="text/javascript"></script>
    <!--/less-->

    <link href="/static/css/admin.css" rel="stylesheet" type="text/css">

    <script src="/vendor/js/jquery-1.11.0.min.js"></script>
    <script src="/vendor/semantic-1.12.3/semantic.min.js"></script>
    <script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/vendor/bootstrap/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    <script src="/vendor/js/jquery.address.js"></script>
    <script src="/vendor/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="/static/js/admin.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/vendor/js/html5shiv.js"></script>
    <script src="/vendor/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

{{ partial('admin/nav') }}

<div class="">
    {% if registry.cms['TECHNICAL_WORKS'] %}
        <div class="ui red inverted segment">
            The site under maintenance.<br>
            Please do not perform any action until the work is completed.
        </div>
    {% endif %}

    {% if title is defined %}
        <h1>{{ title }}</h1>
    {% endif %}

    {% if languages_disabled is not defined %}
        {{ partial('admin/languages') }}
    {% endif %}

    {{ flash.output() }}

    {{ content() }}

</div>

{{ assets.outputJs('modules-admin-js') }}

</body>
</html>