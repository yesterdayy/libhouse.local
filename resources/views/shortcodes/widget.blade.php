@if ($ajax)
    @if ($comments)
        @each('/shortcodes/comment/list_comment', $comments, 'comment');
    @endif
@else
    <div class="widget-block {{ $widget_class }}-wrap" {!! $shortcode_string_args !!}>
        @yield('before-widget')

        @if ($widget_title !== 'false')
            <div class="widget-title {{ $widget_class }}-title">{{ $widget_title }}</div>
        @endif
        <div class="{{ $widget_class }}-content d-inline-block w-100">
            @yield('widget-content')
        </div>

        @yield('after-widget')
    </div>
@endif
