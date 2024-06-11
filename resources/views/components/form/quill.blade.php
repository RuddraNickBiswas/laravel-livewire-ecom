@props(['id' => 'Quill_editor_id', 'model' => '', 'toolbar' => 'simple', 'theme' => 'snow', 'value' => ''])
<div wire:ignore>
    <div id="{{ $id }}"
        name="{{ $id }}">
        {!! $value !!}
    </div>
</div>

{{-- @push('styles')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.bubble.css" />
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css"
        rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
@endpush --}}

@script
    <script>
        document.addEventListener('livewire:navigated', () => {

            const full = [
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                ['bold', 'italic', 'underline', 'strike'],
                ['link', 'image', 'video'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }],
                [{
                    'align': []
                }],
                ['blockquote', 'code-block'],
                [{
                    'color': []
                }, {
                    'background': []
                }],
                ['clean']

            ];

            const normal = [
                [{
                    'header': [1, 2, 3, false]
                }],
                ['bold', 'italic', 'underline'],
                ['link'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'align': []
                }],
                ['blockquote'],
                [{
                    'color': []
                }],
                ['clean']
            ];

            const simple = [
                ['bold', 'italic'],
                ['link'],
                [{
                    'list': 'bullet'
                }],
                ['clean']
            ];

            var quill = new Quill('#{{ $id }}', {
                modules: {

                    toolbar: {{ $toolbar }},


                },
                placeholder: 'Type your text here...',
                theme: '{{ $theme }}' // or 'bubble'
            });
            quill.on('text-change', function(data) {

                let value = document.getElementsByClassName('ql-editor')[0].innerHTML;

                @this.set('{{ $model }}', value)


            })


        })
    </script>
@endscript
