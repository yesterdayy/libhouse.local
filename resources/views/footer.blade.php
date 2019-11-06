<!-- TOASTS -->
<div class="toasts-wrap">
    <div id="default-toast" class="toast d-none" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-body"></div>
    </div>
</div>

@if (isset($modals))
    <script>
        var modals = {!! $modals !!};

        $(function () {
            modals.forEach(function(modal) {
                $('body').on('click', modal.selector, function () {
                    show_modal(modal);
                })
            })
        });
    </script>
@endif
