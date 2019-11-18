@extends(!Request::ajax() ? 'index' : 'ajax')

@section('content')
    [realty-list widget_title="false" type="search" paginated="1"]
@endsection
