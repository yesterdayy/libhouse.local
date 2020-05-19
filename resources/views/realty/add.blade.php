@extends('index_no_sidebar')

@section('content')
    <div class="realty-form-wrap">
        {!! get_page_breadcrumbs($page_title) !!}

        {{ Form::open(['action' => 'RealtyController@store', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class' => 'realty-create-form']) }}
            @include('realty.form')
        {{ Form::close() }}
    </div>
@endsection
