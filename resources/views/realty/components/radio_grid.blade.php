@if ($loop->iteration == 1)
    <div class="d-table-row">
@endif

@if ($loop->iteration != 1 && ($loop->iteration - 1) % $delimeter == 0)
    </div><div class="d-table-row">
@endif

<div class="d-table-cell">
    {{ Form::radio($alias, $item->id, (isset($old[$alias]) && !empty($old[$alias]) ? (boolean) ($old[$alias] == $item->id) : false), ['class' => 'radio', 'id' => $alias . '_' . $item->id]) }}
    {{ Form::label($alias . '_' . $item->id, $item->name) }}
</div>

@if ($loop->last)
    </div>
@endif
