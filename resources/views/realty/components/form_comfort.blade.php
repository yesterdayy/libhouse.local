<div class="col-md-3">
    {{ Form::checkbox('comfort['.$comfort->id.']', '1', null, ['class' => 'form-check-input']) }}
    {!! Form::rawLabel('comfort['.$comfort->id.']', '<span class="red"></span>' . $comfort->name, ['class' => 'form-check-label']) !!}
</div>
