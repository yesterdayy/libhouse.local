<div class="{{ $widget_class }}-article col-3 mt-4">
    <div>ID: {{ $comment->id }}</div>
    <div>Рейтинг: {{ $comment->rating }}</div>
    <div>Сообщение: {{ $comment->message }}</div>
    <div>ТЕСТ: {{ $comment->entry()->title }}</div>
</div>
