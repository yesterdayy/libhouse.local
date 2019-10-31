@extends('index_no_sidebar')

@section('content')
    <div class="realty-create-wrap">
        <h1>Новое объявление</h1>

        {{ Form::open(['action' => 'RealtyController@store', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class' => 'realty-create-form']) }}
            @include('realty.form')
        {{ Form::close() }}
    </div>
@endsection
