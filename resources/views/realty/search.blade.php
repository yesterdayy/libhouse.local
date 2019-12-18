@extends(!Request::ajax() ? 'index' : 'ajax')

@section('content')
    [realty-search paginated="1"]
@endsection
