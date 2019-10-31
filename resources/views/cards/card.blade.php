<div class="cards">
    <div class="cards-block-title landing-title"><span class="text-biz">П</span>РОГРАММЫ</div>
    @foreach ($cards as $card)
        <div class="card">
            <p class="card-title">{{ $card->title }}</p>
            <p class="card-cost">{{ ($card->meta()->where('field', 'cost')->count() > 0 ? '$ ' . $card->meta()->where('field', 'cost')->first()->value : '') }}</p>

            <div class="card-content">
                {!! $card->content !!}
            </div>
        </div>
    @endforeach
</div>