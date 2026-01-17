@props(['field'])

@if ($errors->has($field))
    <span class="text-danger" style="color: red; font-size: 0.875em;">
        {{ $errors->first($field) }}
    </span>
@endif
