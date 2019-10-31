<div class="comment {{ $class ?? '' }}" data-id="{{ $comment->id }}" data-root-id="{{ $root_parent_id }}">
    <div class="comment-wrap">
        <div class="comment-avatar">
            <img src="/upload/avatars/no_ava.jpg">
        </div>

        <div class="comment-body">
            <div class="comment-header">
                <div class="comment-reply-btn float-right" data-reply-text="Ответить" data-reply-cancel-text="Отмена">Ответить</div>
                <span class="comment-user-name">Гость</span> <span class="comment-datetime"><i class="icon icon-clock"></i>{{ mb_convert_case(get_locale_date($comment->created_at, 'F j, Y'), MB_CASE_TITLE, "UTF-8") }}</span>
            </div>

            <div class="comment-content">
                {!! nl2br($comment->message) !!}
            </div>
        </div>
    </div>
</div>