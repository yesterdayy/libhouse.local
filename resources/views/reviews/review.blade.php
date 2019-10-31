{{--
<div class="reviews">
    <div class="review-prev"><i class="icon icon-arrow-left"></i></div>

    @foreach ($reviews as $review)
        <div class="review">
            <div class="review-comma"><i class="icon icon-comma"></i><i class="icon icon-comma"></i></div>

            <div class="review-content">
                {!! $review->message !!}
            </div>

            <p class="review-avatar"><img src="/upload/avatars/{{ $review->customer_ava }}" /></p>

            <p class="review-name">{{ $review->customer_name }}</p>

            <p class="review-source">{{ $review->name }}</p>
        </div>
    @endforeach

    <div class="review-next"><i class="icon icon-arrow-right"></i></div>
</div>--}}

<div class="reviews">
    @foreach ($reviews as $review)
        <div class="review">
            <div class="review-comma"><i class="icon icon-comma"></i><i class="icon icon-comma"></i></div>

            <div class="review-content">
                {!! $review->content !!}
            </div>

            <p class="review-avatar"><img src="@if ($review->cover->count() > 0)/storage/{{ $review->cover->first()->path }}/{{ $review->cover->first()->name . '.jpg' }}@else /upload/avatars/no_ava.jpg @endif" /></p>

            <p class="review-name">{{ $review->title }}</p>

            <p class="review-source">{{ $review->meta()->where('field', 'source')->first()->value }}</p>
        </div>
    @endforeach
</div>

<script>
    $('.reviews').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        prevArrow: '<div class="review-prev"><i class="icon icon-arrow-left"></i></div>',
        nextArrow: '<div class="review-next"><i class="icon icon-arrow-right"></i></div>',
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 760,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
        ],
    });
</script>