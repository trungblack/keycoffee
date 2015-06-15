<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv = "Content-Type" content="text/html">
    <title>Moc Khoa Nha Nha</title>

    {{ helper.meta().get('description') }}
    {{ helper.meta().get('keywords') }}
    {{ helper.meta().get('seo-manager') }}
    <meta property="og:site_name" content="-CUSTOMER VALUE-">
    <meta property="og:title" content="-CUSTOMER VALUE-">
    <meta property="og:description" content="-CUSTOMER VALUE-">
    <meta property="og:type" content="website">
    <meta property="og:image" content="-CUSTOMER VALUE-">
    <!-- link to image for socio -->
    <meta property="og:url" content="-CUSTOMER VALUE-"> <!-- Global styles START -->
    <link href="../../" rel="stylesheet/">

    <link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">



    {#{{ assets.outputJs('js') }}#}
    {{ assets.outputCss('theme-css') }}
    {{ assets.outputLess('modules-less')}}
    {#{{ helper.javascript('head') }}#}

</head>
<body>

<div id="">
    {{ content() }}
    {{ assets.outputJs('theme-js') }}
</div>

</body>
</html>