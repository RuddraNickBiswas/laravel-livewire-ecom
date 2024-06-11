<div>


    <div wire:ignore>
        <div id="{{ $quillId }}"></div>
    </div>



    <!-- Include the Quill library -->





    <!-- Initialize Quill editor -->

    @script
        <script>
            document.addEventListener('livewire:navigated', () => {

                const quill = new Quill('#{{ $quillId }}', {

                    theme: 'snow'

                });

                quill.on('text-change', function() {

                    let value = document.getElementsByClassName('ql-editor')[0].innerHTML;

                    @this.set('value', value)

                })


            })
        </script>
    @endscript
</div>
