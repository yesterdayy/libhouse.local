<div class="comments-add-title">Добавить комментарий</div>

<form class="comments-add">
    @if (isset($shortcode_args['rating_comments']) && $shortcode_args['rating_comments'])
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-danger">
                <input type="radio" name="rating" value="-1" autocomplete="off"> Отрицательный
            </label>

            <label class="btn btn-default active">
                <input type="radio" name="rating" value="0" autocomplete="off"> Нейтральный
            </label>

            <label class="btn btn-success">
                <input type="radio" name="rating" value="1" autocomplete="off" checked> Положительный
            </label>
        </div>
    @endif
    <textarea name="message" class="comments-textarea" required></textarea>
    <input type="hidden" name="reply_to" />
    <input type="hidden" name="root_reply_to" />
    <button class="btn btn-xs comments-add-btn active">Отправить</button>
</form>
