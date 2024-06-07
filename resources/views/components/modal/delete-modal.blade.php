@props([
    'title' => 'Delete Item',
    'showModal' => 'showDeleteModal',
    'submitAction' => 'save',
])

<x-modal wire:model="{{ $showModal }}">
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

                <form wire:submit.prevent="{{ $submitAction }}"
                    class="form"
                    action="#"
                    x-data="{ confirmation: '' }">
                    <div class="mb-13">
                        <h1 class="mb-3">{{ $submitAction }}</h1>

                        <!--begin::Description-->
                        <div class="text-muted fw-semibold fs-5">Are you sure this operation is permanent! cant be reverced
                            {{-- <a href="#"
                                class="fw-bold link-primary">Project Guidelines</a>. --}}
                        </div>
                        <!--end::Description-->
                    </div>

                    <div class="row gap-3">
                        <label class="col-md-12">
                            <h3 class="form-label">Type "CONFIRM"</h3>
                            <input type="text"
                                x-model="confirmation"
                                name="confirmation"
                                placeholder="CONFIRM"
                                aria-describedby="form confirmation"
                                class="form-control"
                                :class="{ 'border-danger border-2': confirmation !== 'CONFIRM' }">
                        </label>
                    </div>

                    <x-modal.footer>
                        <div class="text-center">
                            <x-modal.close>
                                <button type="reset"
                                    class="btn btn-light me-3"
                                    >Cancel</button>
                            </x-modal.close>
                            <button :disabled="confirmation !== 'CONFIRM'"
                                type="submit"
                                class="btn btn-danger">
                                <span class="indicator-label">Delete</span>
                                <span wire:loading
                                    wire:target="{{ $submitAction }}">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </x-modal.footer>
                </form>

            </div>
        </div>
    </x-modal.panel>
</x-modal>
