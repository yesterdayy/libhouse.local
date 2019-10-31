<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $settings::get('title') }} - {{ get_page_meta_title() }}</title>
    <meta name="description" content="{{ get_page_meta_description() }}" />
    <meta name="keywords" content="{{ get_page_meta_keywords() }}" />

    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{ get_page_meta_title() }}"/>
    <meta property="og:description" content="get_page_meta_description()"/>
    @if (!empty(get_post_thumbnail_url('thumb')))
    <meta property="og:image" content="{{ get_post_thumbnail_url('thumb') }}"/>
    @endif
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:site_name" content="{{ $settings::get('title') }}"/>

    <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto+Slab" rel="stylesheet">

    {{ Html::script('plugins/jquery/jquery-3.3.1.min.js') }}
    {{ Html::script('plugins/bootstrap/bootstrap.min.js') }}

    {{ Html::script('plugins/slick/slick.min.js') }}
    {{ Html::style('plugins/slick/slick.css') }}

    {{ Html::script('plugins/responsive-menu/grt-responsive-menu.js') }}
    {{ Html::style('plugins/responsive-menu/grt-responsive-menu.css') }}

    {{ Html::script('plugins/masonry/masonry.pkgd.min.js') }}

    {{ Html::style('sass/style.css') }}
    {{ Html::style('plugins/bootstrap/bootstrap.css') }}
    {{ Html::script('js/scripts.js') }}
    {{ Html::script('/plugins/ekko-lightbox/ekko-lightbox.min.js') }}
</head>
<body class="<?= $page_class ?>">

@include('header')

<div class="content-wrap">
    <div class="blog-info-wrap row">
        <div class="col-md-7">
            <h2 class="blog-title">{!! $settings::get('blog_title') !!}</h2>
            <h3 class="blog-subtitle">{!! $settings::get('blog_subtitle') !!}</h3>
        </div>

        <div class="col-md-5">
            [form id="4"]
        </div>
    </div>

    <div class="page-content">
        @yield('content')
    </div>
</div>

@include('landing_footer')
</body>
</html>