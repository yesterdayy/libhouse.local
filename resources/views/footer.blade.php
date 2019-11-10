<!-- SUCCESS FORM MODAL -->
<div class="modal fade" id="success-form-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title"></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body"></div>

            <div class="modal-footer"></div>
        </div>
    </div>
</div>

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
