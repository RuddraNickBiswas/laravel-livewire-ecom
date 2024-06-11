<div>

    <x-admin.layout.partials.toolbar :title=$title
        :breadcrumbs=$breadcrumbs>
        <x-admin.layout.partials.toolbar.action>
            <x-modal>
                <x-modal.open>
                    <button class="btn btn-primary fs-7 fw-bold">Hi Model</button>
                </x-modal.open>
                <x-modal.panel>
                    <h1>hi</h1>
                </x-modal.panel>
            </x-modal>
        </x-admin.layout.partials.toolbar.action>
    </x-admin.layout.partials.toolbar>



    <x-admin.layout.partials.content>

        <form wire:ignore
            wire:submit='save'
            action="#">

            <div id="Quill_demo_comp"
                name="Quill_demo_comp">
                <h1>Quick and Simple Quill Integration</h1>
                <p>Here goes the&nbsp;<a href="#">Minitial content of the editor</a>. Lorem Ipsum is simply dummy text of the&nbsp;<em>printing
                        and typesetting</em>&nbsp;industry.</p>
                <blockquote>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                    type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</blockquote>
                <h3 style="text-align: right;">Flexible &amp; Powerful</h3>
                <p style="text-align: right;"><strong>Lorem Ipsum has been the industry's</strong>&nbsp;standard dummy text ever since the 1500s, when
                    an unknown printer took a galley of type and scrambled.</p>
                <ul>
                    <li>List item 1</li>
                    <li>List item 2</li>
                    <li>List item 3</li>
                    <li>List item 4</li>
                </ul>
            </div>


            <button class="btn btn-primary">Save</button>
        </form>

        <div class="card">
            {!! $text !!}
        </div>

    </x-admin.layout.partials.content>

</div>


@script
    <script>
        document.addEventListener('livewire:navigated', () => {

            const defaultToolbarOptions = [
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
            var quill = new Quill('#Quill_demo_comp', {
                modules: {

                    toolbar: defaultToolbarOptions,


                },
                placeholder: 'Type your text here...',
                theme: 'snow' // or 'bubble'
            });
            quill.on('text-change', function(data) {

                let value = document.getElementsByClassName('ql-editor')[0].innerHTML;

                @this.set('text', value)


            })


        })
    </script>
@endscript
