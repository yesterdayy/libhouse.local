@extends(!Request::ajax() ? 'index' : 'ajax')

@section('content')

    <div class="row">
        <div class="col-md-6">
            {!! get_breadcrumbs($realty) !!}
        </div>

        <div class="col-md-6">
            @include('components.realty_nav')
        </div>
    </div>

    <article class="realty-single">
        <h1>{{ $realty->title }}</h1>
        <div class="realty-favorite text-right"><i class="lh-icon lh-icon-heart"></i><span>в избранное</span></div>

        @if (get_realty_photos($realty)->count() > 0)
            <div class="realty-single-photo">
                @foreach (get_realty_photos($realty) as $photo)
                    <div class="realty-img"><img data-lazy="/storage/{{ $photo->path }}{{ $photo->name . '.' . $photo->extension }}" /></div>
                @endforeach
            </div>

            <div class="realty-single-photo-nav">
                @foreach (get_realty_photos($realty) as $photo)
                    <div class="realty-img"><img data-lazy="/storage/{{ $photo->path }}{{ $photo->name . '.' . $photo->extension }}" /></div>
                @endforeach
            </div>

            <script>
                $('.realty-single-photo').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    draggable: false,
                    swipe: false,
                });

                $('.realty-single-photo-nav').slick({
                    slidesToShow: {{ get_realty_photos($realty)->count() }},
                    slidesToScroll: 1,
                    arrows: false,
                    asNavFor: '.realty-single-pboto',
                    respondTo: 'slide',
                    focusOnSelect: true,
                    draggable: false,
                    swipe: false,
                });
            </script>
        @endif
    </article>

    [comments id="{{ $realty->id }}" type="realty" rating_comments="1"]
@endsection
