<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $settings::get('title') ? $settings::get('title') : 'Admin' }}</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto+Slab" rel="stylesheet">

    {{ Html::script('plugins/jquery/jquery-3.3.1.min.js') }}
    {{ Html::script('plugins/bootstrap/bootstrap.min.js') }}

    {{ Html::script('plugins/slick/slick.min.js') }}
    {{ Html::style('plugins/slick/slick.css') }}

    {{ Html::script('plugins/responsive-menu/grt-responsive-menu.js') }}
    {{ Html::style('plugins/responsive-menu/grt-responsive-menu.css') }}

    {{ Html::style('sass/style.css') }}
    {{ Html::style('plugins/bootstrap/bootstrap.css') }}
    {{ Html::script('js/scripts.js') }}
</head>
<body class="<?= isset($page_class) ? $page_class : '' ?>">

@include('header')

<div class="content-wrap">
    <div class="page-content">
        @yield('content')
    </div>
</div>

@include('landing_footer')
</body>
</html>