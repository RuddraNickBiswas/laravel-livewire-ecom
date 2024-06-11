@props([
    'title' => 'Create Category',
    'showModal' => 'showModal',
    'submitAction' => 'save',
])
{{-- $form->thumbnail->temporaryUrl()  --}}
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
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <div class="row gap-3">


                        <div  class="col-md-5 card card-flush py-4">
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
                            <div wire:ignore class="card-body text-center pt-0">
                                <!--begin::Image input-->
                                <!--begin::Image input placeholder-->
                                <style>
                                    .image-input-placeholder {
                                        background-image: url('assets/media/svg/files/blank-image.svg');
                                    }

                                    [data-bs-theme="dark"] .image-input-placeholder {
                                        background-image: url('assets/media/svg/files/blank-image-dark.svg');
                                    }
                                </style>
                                <!--end::Image input placeholder-->
                                <!--begin::Image input-->
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                    data-kt-image-input="true">
                                    <!--begin::Preview existing avatar-->
                                    @if (false)
                                    <div class="image-input-wrapper w-150px h-150px" style="background-image: url(assets/media//stock/ecommerce/123.png)"></div>
                                    @else
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    @endif
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change"
                                        data-bs-toggle="tooltip"
                                        aria-label="Change avatar"
                                        data-bs-original-title="Change avatar"
                                        data-kt-initialized="1">
                                        <!--begin::Icon-->
                                        <i class="ki-outline ki-pencil fs-7"></i>
                                        <!--end::Icon-->
                                        <!--begin::Inputs-->
                                        <input type="file"
                                        wire:model='form.thumbnail'
                                            name="avatar"
                                            accept=".png, .jpg, .jpeg">
                                        <input type="hidden"
                                            name="avatar_remove">
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel"
                                        data-bs-toggle="tooltip"
                                        aria-label="Cancel avatar"
                                        data-bs-original-title="Cancel avatar"
                                        data-kt-initialized="1">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                    <!--end::Cancel-->
                                    <!--begin::Remove-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove"
                                        data-bs-toggle="tooltip"
                                        aria-label="Remove avatar"
                                        data-bs-original-title="Remove avatar"
                                        data-kt-initialized="1">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                    <!--end::Remove-->
                                </div>
                                <!--end::Image input-->
                                <!--begin::Description-->
                                <div class="text-muted fs-7">Set the category thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted
                                </div>
                                <!--end::Description-->
                            </div>
                            @error('form.thumbnail')
                            <h6 class="text-danger fst-italic"
                                aria-live="assertive">{{ $message }}</h6>
                        @enderror
                            <!--end::Card body-->
                        </div>


                        <div class="col-md-6 ">


                            <div class="row">

                                <div class="col-12 mb-10">
                                    <x-form.input wire:model='form.photos'
                                        model="form.photos.*"
                                        name="photos"
                                        required
                                        type="file"
                                        multiple
                                        placeholder="photos"
                                        label="photos" />
                                </div>

                                <div class="col-12 mb-10">
                                    <x-form.input wire:model='form.name'
                                        model="form.name"
                                        name="name"
                                        required
                                        type="text"
                                        placeholder="name"
                                        label="Name" />
                                </div>
                                <div class="col-12">
                                    <x-form.select wire:model.boolean='form.is_active'
                                        model="form.is_active"
                                        name="is Active"
                                        placeholder="Active or not"
                                        label="status">
                                        <option value="false">Diactive</option>
                                        <option value="true">Active</option>
                                    </x-form.select>
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
