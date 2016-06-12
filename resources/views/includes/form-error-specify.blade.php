@if ($errors->has($field))
    <ul class="list-group">
        <div class="alert alert-info">
            {{ $errors->first($field) }}
        </div>
    </ul>
@endif