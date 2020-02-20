@php $slugs = []; @endphp
@foreach ($breadcrumbs as $k => $breadcrumb)
    @php $slugs[] = $breadcrumb['slug']; @endphp
    <a href="{{ route('realty.cat', ['slugs' => implode('/', $slugs)]) }}">{{ $breadcrumb['name'] }}</a> {{ $k < (count($breadcrumbs) - 1) ? '/' : '' }}
@endforeach
