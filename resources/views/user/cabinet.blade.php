@extends('index')

@section('content')
    <div class="container">
        @if ($is_my_page)
            <h1>Добро пожаловать домой</h1>
        @else
            <h1>{{ $user->id }} - {{ $is_my_page }}</h1>
        @endif

        <h4>Рейтинг: {{ $user->realty_comment_rating->rating }}</h4>
        <hr>
        [realty-list author_id="{{ $user->id }}" widget_title="Объявления пользователя" ajax_url="/realty/get_realty_list_widget"]
        <hr>
        [user-comments-list author_id="{{ $user->id }}" widget_title="Отзывы пользователя" type="realty" ajax_url="/adv/get_realty_comments_widget"]
    </div>
@endsection
