<div class="form-group">
    <label>Прокомментированный материал</label>
    <div><a href="{{ route('platform.screens.'.$comment->post->type.'s.edit', $comment->post->id) }}" class="text-primary">{{ $comment->post->title }}</a></div>
</div>

<div class="form-group">
    <label>Автор</label>
    <div>{{ $comment->author->name }}</div>
</div>

<div class="form-group">
    <label>Сообщение</label>
    <div class="alert alert-info">{{ $comment->message }}</div>
</div>

@foreach ($form as $row)
    {!! $row !!}
@endforeach