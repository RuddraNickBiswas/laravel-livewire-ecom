@props([
    'title' => 'Create Category',
    'showModal' => 'showModal',
    'submitAction' => 'save'
])
<x-modal wire:model='{{ $showModal }}'>
    <x-modal.open>
       {{ $slot }}
    </x-modal.open>
    <x-modal.panel>
        <div class="modal-content rounded">
            <x-modal.close>

                <div class="modal-header pb-0 border-0 justify-content-end">

                    <div class="btn btn-sm btn-icon btn-active-color-primary">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>

                </div>
            </x-modal.close>

            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">

                <form wire:submit="{{ $submitAction }}"
                    class="form"
                    action="#">

                    <div class="mb-13 ">

                        <h1 class="mb-3">{{ $title }}</h1>

                        {{-- <!--begin::Description-->
                        <div class="text-muted fw-semibold fs-5">If you need more info, please check
                        <a href="#" class="fw-bold link-primary">Project Guidelines</a>.</div>
                        <!--end::Description--> --}}
                    </div>

                    <div class="row gap-3">
                        <x-form.input model="form.name"
                            name="name"
                            type="text"
                            placeholder="name"
                            label="Name" />

                    </div>
                    <x-modal.footer>

                        <div class="text-center">
                            <x-modal.close>
                                <button type="reset"
                                    class="btn btn-light me-3">Cancel</button>
                            </x-modal.close>
                            <button type="submit"
                                class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span wire:loading
                                    wire:target='save'
                                    class="">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>


                    </x-modal.footer>
                </form>

            </div>

        </div>
    </x-modal.panel>
</x-modal>
