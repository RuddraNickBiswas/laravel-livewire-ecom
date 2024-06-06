@props(['model', 'name', 'type' => 'text', 'placeholder' => '', 'label' => ''])


<label class="col-md-12">
    @if ($label)
        <h3 class="form-label required">{{ $label }}</h3>
    @endif
    <input wire:model.blur="{{ $model }}"
        type="{{ $type }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        aria-describedby="form {{ $name }}"
        @class([
            'form-control',
            'border-danger border-2' => $errors->has($name),
        ])
        @error($name)
                   aria-invalid="true"
                   aria-description="{{ $message }}"
               @enderror>
    @error($name)
        <h6 class="text-danger fst-italic"
            aria-live="assertive">{{ $message }}</h6>
    @enderror
</label>
