@props(['for'])

@error($for)
    <span {{ $attributes->merge(['class' => 'invalid-feedback d-block']) }} role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
