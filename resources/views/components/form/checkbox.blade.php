@props(['model', 'name', 'label' => '', 'value' => 1])

@php
    $id = $attributes->get('id') ?? $name;
@endphp

<div class="form-check">
    <input
        id="{{ $id }}"
        type="checkbox"
        {{ $attributes->whereStartsWith('wire:model') }}
        name="{{ $name }}"
        value="{{ $value }}"
        @class([
            'form-check-input',
            'border-danger border-2' => $errors->has($model),
        ])
        @error($model)
            aria-invalid="true"
            aria-description="{{ $message }}"
        @enderror>
    <label class="form-check-label" for="{{ $id }}">
        {{ $label }} @if($attributes->has('required'))<span class="text-danger">*</span>@endif
    </label>
    @error($model)
        <h6 class="text-danger fst-italic"
            aria-live="assertive">{{ $message }}</h6>
    @enderror
</div>
