<div>

    <x-admin.layout.partials.toolbar :title=$title :breadcrumbs=$breadcrumbs>
        <x-admin.layout.partials.toolbar.action>
            <x-modal>
                <x-modal.open>
                    <button class="btn btn-primary fs-7 fw-bold">Hi Model</button>
                </x-modal.open>
                <x-modal.panel>
                    <div class="card">
                        <div class="card-body">
                            <h1>hi there  wassup </h1>
                        </div>
                    </div>
                </x-modal.panel>
            </x-modal>
        </x-admin.layout.partials.toolbar.action>
    </x-admin.layout.partials.toolbar>



    <x-admin.layout.partials.content>
        <h1>hi</h1>
    </x-admin.layout.partials.content>

</div>
