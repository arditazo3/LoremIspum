@if ($errors->has($field))
    <ul class="list-group">
        <div class="alert alert-{{ $typeAlert }}">
            {{ $errors->first($field) }}
        </div>
    </ul>
@endif