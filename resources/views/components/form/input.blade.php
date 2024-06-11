@props(['model', 'name', 'type' => 'text', 'placeholder' => '', 'label' => ''])




<label class="col-12">
    @if ($label)
        <h3 class="form-label">{{ $label }} @if ($attributes->has('required'))
                <span class="text-danger">*</span>
            @endif
        </h3>
    @endif
    <input @if ($attributes->whereStartsWith('wire:model')->isNotEmpty()) {{ $attributes->whereStartsWith('wire:model') }}
    @else
    wire:model="{{ $model }}" @endif
        type="{{ $type }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        aria-describedby="form {{ $name }}"
        {{ $attributes }}
        @class([
            'form-control',
            'border-danger border-2' => $errors->has($model),
        ])
        @error($model)
                   aria-invalid="true"
                   aria-description="{{ $message }}"
               @enderror>
    @error($model)
        <h6 class="text-danger fst-italic"
            aria-live="assertive">{{ $message }}</h6>
    @enderror
</label>
