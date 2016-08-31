@if ($errors->has($field))
    <ul class="list-group">
        <div class="alert alert-{{ $typeAlert }}">
            @if($errors->has('captcha'))
                Captcha, wrong letters!
            @else
                {{ $errors->first($field) }}
            @endif
        </div>
    </ul>
@endif