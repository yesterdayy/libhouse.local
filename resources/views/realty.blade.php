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
    {{ Html::script('plugins/bootstrap/bootstrap.min.js') }}

    {{ Html::script('plugins/slick/slick.min.js') }}
    {{ Html::style('plugins/slick/slick.css') }}

    {{ Html::script('plugins/responsive-menu/grt-responsive-menu.js') }}
    {{ Html::style('plugins/responsive-menu/grt-responsive-menu.css') }}

    {{ Html::script('plugins/select2/select2.full.min.js') }}
    {{ Html::style('plugins/select2/select2.min.css') }}

    {{ Html::script('plugins/dropzone/dropzone.min.js') }}
    {{ Html::style('plugins/dropzone/basic.min.css') }}
    {{ Html::style('plugins/dropzone/dropzone.min.css') }}

    {{ Html::style('sass/style.min.css') }}
    {{ Html::style('plugins/bootstrap/bootstrap.min.css') }}
    {{ Html::style('plugins/bootstrap/bootstrap.min.js') }}
    {{ Html::script('js/scripts.js') }}
</head>
<body class="<?= $page_class ?? '' ?>">
    @include('header')

    <div class="blog-info-wrap">
        <ul>
            <li><a href="{{ url('/register') }}"> register </a></li>
            <li><a href="{{ url('/login') }}"> login </a></li>
            <li><a href="{{ url('/logout') }}"> logout </a></li>
            <li><a href="{{ url('/reset/password') }}"> reset password </a></li>
        </ul>

        @yield('content')
    </div>

    @include('footer')
</body>
</html>
