@extends(!Request::ajax() ? 'index' : 'ajax')

@section('content')
    {{ Form::model($realty, ['action' => ['RealtyController@update', $realty->slug], 'method' => 'put', 'enctype' => 'multipart/form-data']) }}
        @include('realty.form')
    {{ Form::close() }}
@endsection
