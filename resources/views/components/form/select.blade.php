@props(['model', 'name', 'options' => [], 'placeholder' => '', 'label' => ''])

<label class="col-12">
    @if ($label)
        <h3 class="form-label">{{ $label }} @if ($attributes->has('required'))
                <span class="text-danger">*</span>
            @endif
        </h3>
    @endif
    <select
     @if ($attributes->whereStartsWith('wire:model')->isNotEmpty()) {{ $attributes->whereStartsWith('wire:model') }}
    @else
    wire:model="{{ $model }}" @endif
        name="{{ $name }}"
        aria-describedby="form {{ $name }}"
        @class([
            'form-control',
            'border-danger border-2' => $errors->has($model),
        ])
        @error($model)
            aria-invalid="true"
            aria-description="{{ $message }}"
        @enderror>
        @if ($placeholder)
            <option value=""
                disabled
                selected>{{ $placeholder }}</option>
        @endif
        @if ($options)
            @foreach ($options as $value => $text)
                <option value="{{ $value }}">{{ $text }}</option>
            @endforeach
        @else
            {{ $slot }}
        @endif

    </select>
    @error($model)
        <h6 class="text-danger fst-italic"
            aria-live="assertive">{{ $message }}</h6>
    @enderror
</label>
