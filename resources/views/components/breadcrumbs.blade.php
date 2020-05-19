<div class="breadcrumbs">
    @php $slugs = []; @endphp
    @foreach ($breadcrumbs as $k => $breadcrumb)
        @php $slugs[] = $breadcrumb['slug']; @endphp
        @if ($k < count($breadcrumbs) - 1)
            <a href="{{ route('realty.cat', ['slugs' => implode('/', $slugs)]) }}">{{ $breadcrumb['name'] }}</a> <span class="separator">/</span>
        @else
            <span>{{ $breadcrumb['name'] }}</span>
        @endif
    @endforeach
</div>
