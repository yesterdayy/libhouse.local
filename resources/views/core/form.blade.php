<form class="form-biz{{ ($form->div_class ? ' ' . $form->div_class : "") }}" {!! ($form->div_id ? "id='{$form->div_id}'" : "") !!} data-form-id="{{ $form->id }}">
    @foreach ($form_fields as $field)
        @switch ($field->type)
            @case ('contact-btn')
                <div class="form-contact-btn">
                    {!! ($field->label ? "<label>$field->label</label>" : "") !!}
                    <div class="btn-group">
                        <div class="email active" data-placeholder="SPARROW@MAIL.RU"><i class="icon icon-group icon-email"></i>Email</div>
                        <div class="viber" data-placeholder="Номер телефона"><i class="icon icon-group icon-viber"></i>Viber</div>
                        <div class="whatsapp" data-placeholder="Номер телефона"><i class="icon icon-group icon-whatsapp"></i>WhatsApp</div>
                        <div class="telegram" data-placeholder="Ваши контакты"><i class="icon icon-group icon-telegram"></i>Telegram</div>
                    </div>

                    <div class="form-input">
                        <input type="email"
                               name="email"
                               class="contact-input"
                               placeholder="Email"
                               required />
                    </div>
                </div>
                @break

            @case ('pay-btn')
                <div class="form-pay-btn">
                    {!! ($field->label ? "<label>$field->label</label>" : "") !!}
                    <div class="btn-group">
                        <div class="yandex-money active"><i class="icon icon-group icon-yandex-money"></i></div>
                        <div class="qiwi"><i class="icon icon-group icon-qiwi"></i></div>
                        <div class="webmoney"><i class="icon icon-group icon-webmoney"></i></div>
                        <div class="rnkb"><i class="icon icon-group icon-rnkb"></i></div>
                    </div>

                    <div class="form-input form-payment-details">
                        <label>Реквизиты для оплаты</label>
                        <input type="text"
                               name="payment_detail"
                               class="input-payment-detail"
                               readonly />

                        <div class="form-copy-payment-details"><i class="icon icon-copy"></i> копировать</div>

                        <script>
                            var payment_details = {!! get_json_payment_details() !!};
                            $(function () {
                                payment_input_init({{ $form->id }});
                            });
                        </script>
                    </div>

                    <label class="label-black">После оплаты, пришлите скрин чека <a href="{{ $settings::get('admin_link') }}">администратору сайта</a></label>
                </div>

                <div class="form-file">
                    <input type="file" name="check" id="file-{{ $form->id }}" required>
                    <label for="file-{{ $form->id }}"><i class="icon icon-input-file"></i>ЗАГРУЗИТЬ ФОТО ЧЕКА</label>
                </div>
                @break

            @case ('textarea')
                <div class="form-textarea">
                    {!! ($field->label ? "<label>$field->label</label>" : "") !!}
                    <textarea name="{{ $field->name }}"
                            {!! ($field->div_class ? "class='$field->div_class'" : "") !!}
                            {!! ($field->div_id ? "id='$field->div_id'" : "") !!}
                            {!! ($field->placeholder ? "placeholder='$field->placeholder'" : "") !!}
                            {!! ($field->is_required ? "required" : "") !!} ></textarea>
                </div>
                @break

            @case ('file')
                <div class="form-file">
                    <input type="file" name="{{ $field->name }}" id="file-{{ $field->id }}" required>
                    <label for="file-{{ $field->id }}"><i class="icon icon-file"></i> {{ $field->label }}</label>
                </div>
                @break;

            @default
                <div class="form-input">
                    {!! ($field->label ? "<label>$field->label</label>" : "") !!}
                    <input type="{{ $field->type }}"
                           name="{{ $field->name }}"
                            {!! ($field->value ? "value='$field->value'" : "") !!}
                            {!! ($field->div_class ? "class='$field->div_class'" : "") !!}
                            {!! ($field->div_id ? "id='$field->div_id'" : "") !!}
                            {!! ($field->placeholder ? "placeholder='$field->placeholder'" : "") !!}
                            {!! ($field->is_required ? "required" : "") !!} />
                </div>
                @break
        @endswitch
    @endforeach

    @if ($form->is_personal)
        <div class="form-check">
            <input type="checkbox" name="personal" id="form-{{ $form->id }}-personal" required>
            <label for="form-{{ $form->id }}-personal"></label>
            <label>Оставляя свои контактные данные в этой форме, вы даете свое <a href="#">согласие на обработку</a> персональных данных</label>
        </div>
    @endif
</form>