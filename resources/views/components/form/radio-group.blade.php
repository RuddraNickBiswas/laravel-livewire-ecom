@props(['model', 'name', 'options' => [], 'label' => ''])

@php
    $id = $attributes->get('id') ?? $name;
@endphp

<label class="col-12">
    @if ($label)
        <h3 class="form-label">{{ $label }} @if($attributes->has('required'))<span class="text-danger">*</span>@endif</h3>
    @endif
    @foreach ($options as $value => $text)
        @php
            $optionId = $id . '_' . $value;
        @endphp
        <div class="form-check">
            <input
                id="{{ $optionId }}"
                type="radio"
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
            <label class="form-check-label" for="{{ $optionId }}">
                {{ $text }}
            </label>
        </div>
    @endforeach
    @error($model)
        <h6 class="text-danger fst-italic"
            aria-live="assertive">{{ $message }}</h6>
    @enderror
</label>
