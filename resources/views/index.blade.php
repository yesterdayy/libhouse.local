<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto+Slab" rel="stylesheet">

    <title>{{ get_page_meta_title() }}</title>
    <meta name="description" content="{{ get_page_meta_description() }}" />
    <meta name="keywords" content="{{ get_page_meta_keywords() }}" />

    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="get_page_meta_title()"/>
    <meta property="og:description" content="get_page_meta_description()"/>
    @if (!empty(get_post_thumbnail_url('thumb')))
        <meta property="og:image" content="{{ get_post_thumbnail_url('thumb') }}"/>
    @endif
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:site_name" content="{{ $settings::get('title') }}"/>

    {{ Html::script('plugins/jquery/jquery-3.3.1.min.js') }}
    {{ Html::script('plugins/jquery/jquery.cookie.min.js') }}
    {{ Html::script('plugins/popper/popper.min.js') }}
    {{ Html::script('plugins/bootstrap/bootstrap.min.js') }}

    {{ Html::script('plugins/dropzone/dropzone.min.js') }}
    {{ Html::style('plugins/dropzone/basic.min.css') }}
    {{ Html::style('plugins/dropzone/dropzone.min.css') }}

    {{ Html::script('plugins/select2/select2.full.min.js') }}
    {{ Html::script('plugins/select2/single_select2.fix.min.js') }}
    {{ Html::style('plugins/select2/select2.min.css') }}

    {{ Html::script('plugins/slick/slick.min.js') }}
    {{ Html::style('plugins/slick/slick.min.css') }}

    {{ Html::script('plugins/autocomplete/jquery.autocomplete.min.js') }}

    {{ Html::style('sass/style.min.css') }}
    {{ Html::style('plugins/bootstrap/bootstrap.min.css') }}
    {{ Html::style('plugins/bootstrap/bootstrap.min.js') }}
    {{ Html::script('js/scripts.min.js') }}

</head>
<body class="<?= $page_class ?? '' ?>">
    @include('header')

    <div class="wrap-content row">
        <div class="col-md-9">
            @yield('content')
        </div>

        <div class="wrap-sidebar col-md-3">
            @yield('sidebar')
        </div>
    </div>

    @include('footer')
</body>
</html>
