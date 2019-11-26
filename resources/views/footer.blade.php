@if (!auth()->check())
    <!-- LOGIN AND REGISTER MODAL -->
    <div class="modal fade" id="auth-form-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content pt-0">
                <div class="modal-body auth-wrap">
                    <ul class="nav auth-tabs" role="tablist">
                        <li>
                            <a class="active" id="nav-login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="nav-login" aria-selected="true">Вход</a>
                        </li>

                        <li>
                            <a id="nav-register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="nav-register" aria-selected="false">Регистрация</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="login" role="tabpanel" aria-labelledby="nav-login-tab">
                            [login-form]
                        </div>

                        <div class="tab-pane" id="register" role="tabpanel" aria-labelledby="nav-register-tab">
                            [register-form]
                        </div>
                    </div>
                </div>

                <div class="modal-body reset-password-wrap d-none">
                    <a href="#" class="btn btn-simple auth-reset-back"><i class="lh-icon lh-icon-arrow-left"></i> Назад</a>
                    [reset-password-form]
                </div>
            </div>
        </div>
    </div>
@endif

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
