<div class="footer">
    {!! get_menu('footer', ['ul_class' => 'footer-menu']) !!}

    <div class="footer-text">
        <div class="footer-col-1">
            <p class="footer-black-text">Дизайн - <a href="https://vk.com/mr_tk"><span class="text-biz">С</span>ергей <span class="text-biz">С</span>пиридонов</a></p>
            <p class="footer-gray-text">Переделывал ∞ раз, и не спал ночами</p>
        </div>

        <div class="footer-col-2">
            <p class="footer-black-text">Верстка - <a href="https://vk.com/yesterdayyy"><span class="text-biz">Ю</span>рий <span class="text-biz">Н</span>ечаев</a></p>
            <p class="footer-gray-text inline-block">Кушал салатик и кодил</p>
            <p class="right">По всем вопросам обращаться на почту <a href="#">pochta@gmail.com.</a></p>
        </div>
    </div>
</div>

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
