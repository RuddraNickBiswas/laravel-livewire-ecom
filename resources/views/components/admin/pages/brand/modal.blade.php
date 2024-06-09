@props([
    'title' => 'Create Category',
    'showModal' => 'showModal',
    'submitAction' => 'save',
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


                        <div class="col-md-5 card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Brand Thumbnail</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body text-center pt-0">
                                <!--begin::Image input-->
                                <!--begin::Image input placeholder-->
                                <style>.image-input-placeholder { background-image: url('assets/media/svg/files/blank-image.svg'); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url('assets/media/svg/files/blank-image-dark.svg'); }</style>
                                <!--end::Image input placeholder-->
                                <!--begin::Image input-->
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                        <!--begin::Icon-->
                                        <i class="ki-outline ki-pencil fs-7"></i>
                                        <!--end::Icon-->
                                        <!--begin::Inputs-->
                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                                        <input type="hidden" name="avatar_remove">
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                    <!--end::Cancel-->
                                    <!--begin::Remove-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                    <!--end::Remove-->
                                </div>
                                <!--end::Image input-->
                                <!--begin::Description-->
                                <div class="text-muted fs-7">Set the category thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </div>


                        <div class="col-md-6 ">
                            <div class="row">

                                <div class="card card-flush py-4" data-select2-id="select2-data-139-8pjh">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Status</h2>
                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">
                                            <div class="rounded-circle w-15px h-15px bg-warning" id="kt_ecommerce_add_category_status"></div>
                                        </div>
                                        <!--begin::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0" data-select2-id="select2-data-138-4byt">
                                        <!--begin::Select2-->
                                        <select class="form-select mb-2 select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_category_status_select" data-select2-id="select2-data-kt_ecommerce_add_category_status_select" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                            <option data-select2-id="select2-data-142-xmar"></option>
                                            <option value="published" selected="selected" data-select2-id="select2-data-8-fzje">Published</option>
                                            <option value="scheduled" data-select2-id="select2-data-143-jwiz">Scheduled</option>
                                            <option value="unpublished" data-select2-id="select2-data-144-7mg6">Unpublished</option>
                                        </select><span class="select2 select2-container select2-container--bootstrap5 select2-container--below" dir="ltr" data-select2-id="select2-data-7-ijfk" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select mb-2" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-kt_ecommerce_add_category_status_select-container" aria-controls="select2-kt_ecommerce_add_category_status_select-container"><span class="select2-selection__rendered" id="select2-kt_ecommerce_add_category_status_select-container" role="textbox" aria-readonly="true" title="Scheduled">Scheduled</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        <!--end::Select2-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Set the category status.</div>
                                        <!--end::Description-->
                                        <!--begin::Datepicker-->
                                        <div class="mt-10">
                                            <label for="kt_ecommerce_add_category_status_datepicker" class="form-label">Select publishing date and time</label>
                                            <input class="form-control flatpickr-input" id="kt_ecommerce_add_category_status_datepicker" placeholder="Pick date &amp; time" type="text" readonly="readonly">
                                        </div>
                                        <!--end::Datepicker-->
                                    </div>
                                    <!--end::Card body-->
                                </div>

                                <div>
                                    <x-form.input model="form.name"
                                        name="name"
                                        type="text"
                                        placeholder="name"
                                        label="Name" />

                                </div>
                            </div>

                        </div>

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
