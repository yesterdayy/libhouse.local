@extends('blog')

@section('content')
    <div class="blog-info-wrap row {{ get_post_meta('template') }}">
        <div class="col-md-12">
            {!! get_post_content() !!}
        </div>
    </div>
@endsection