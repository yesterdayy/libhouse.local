<ul class="realty-paginate-nav float-right text-right">
    <li><a href="{{ url()->previous() }}">Назад</a></li>

    @if ($realty_next)
        <li><a href="{{ $realty_next }}">Следующее</a></li>
    @endif
</ul>
