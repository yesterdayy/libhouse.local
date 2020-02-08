@php $slugs = []; @endphp
@foreach ($breadcrumbs as $breadcrumb)
    @php $slugs[] = $breadcrumb['slug']; @endphp
    <a href="{{ route('realty.cat', ['slugs' => implode('/', $slugs)]) }}">{{ $breadcrumb['name'] }}</a> /
@endforeach
