@push('styles')
    {{-- file pond --}}

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css"
        rel="stylesheet" />
@endpush
<div wire:ignore
    x-data
    x-init="FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginImageEdit);
    FilePond.setOptions({
        allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
allowImageEdit:true,

        server: {
            process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
            },
            revert: (filename, load) => {
                @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
            },
        },
    });
    FilePond.create($refs.input);">
    <input type="file"
        x-ref="input"
        {{ $attributes }}>
</div>

@push('scripts')
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
@endpush
