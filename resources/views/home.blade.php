@extends('index')

@section('content')
    [realty-cats-list widget_title="Категории" widget_class="advertisement-cats-list" commercy="1" with-count="1"]
    [realty-list widget_title="Новые объявления" ajax_url="/adv/get_advertisement_list_widget"]
@endsection
