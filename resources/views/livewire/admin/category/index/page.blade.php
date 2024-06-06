<div>

    <x-admin.layout.partials.toolbar :title=$title
        :breadcrumbs=$breadcrumbs>
        <x-admin.layout.partials.toolbar.action>
            <x-modal>
                <x-modal.open>
                    <button class="btn btn-primary fs-7 fw-bold">Create </button>
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

                            <form wire:submit='save'
                                class="form"
                                action="#">

                                <div class="mb-13 ">

                                    <h1 class="mb-3">Create Category</h1>

                                    {{-- <!--begin::Description-->
                                    <div class="text-muted fw-semibold fs-5">If you need more info, please check
                                    <a href="#" class="fw-bold link-primary">Project Guidelines</a>.</div>
                                    <!--end::Description--> --}}
                                </div>

                                <div class="row gap-3">
                                    <x-form.input model="name"
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
        </x-admin.layout.partials.toolbar.action>
    </x-admin.layout.partials.toolbar>



    <x-admin.layout.partials.content>
        <h1>Category</h1>
        <div class="gap-5 row">
            <div class="col-6">
                {{-- start category group --}}
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-11 card d-flex flex-row align-items-center text-center justify-content-between p-2">
                        <span class="fs-6 text-center">Category Group</span>
                        <button class="btn btn-sm">Action</button>
                    </div>
                </div>
                {{-- end category group --}}
                {{-- start categiry --}}
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10 card d-flex flex-row align-items-center justify-content-between p-2">
                        <span class="fs-6 text-center">Category</span>
                        <button class="btn btn-sm">Action</button>
                    </div>
                </div>
                {{-- end category --}}
                {{-- start sub category --}}
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-9 card d-flex flex-row align-items-center justify-content-between p-2">
                        <span class="fs-6 text-center">Sub Category</span>
                        <button class="btn btn-sm">Action</button>
                    </div>
                </div>
                {{-- end sub category --}}
            </div>

        </div>


        <div class="row">
            <div class="col-6">
                <div id="#kt_app_sidebar_menu"
                    class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-3 mb-5">
                    <div class="menu-item menu-accordion show">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-vertical"></span>
                            </span>
                            <div class="menu-title d-flex justify-content-between">
                                <div>Category Group</div>
                                <div>
                                    <button class="btn btn-sm btn-icon btn-active-color-primary">
                                        <i class="ki-solid ki-message-edit fs-1 "></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon  btn-active-color-danger">
                                        <i class="ki-solid ki-trash-square fs-1"></i>
                                    </button>
                                </div>
                            </div>


                        </span>

                        <div class="menu-sub menu-sub-accordion">

                            <div class="menu-item menu-accordion show">
                                <span class="menu-link"><span class="menu-bullet"><span class="bullet bullet-vertical"></span></span>
                                    <div class="menu-title d-flex justify-content-between">
                                        <div>Category</div>
                                        <div>
                                            <button class="btn btn-sm btn-icon btn-active-color-primary">
                                                <i class="ki-solid ki-message-edit fs-1 "></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon  btn-active-color-danger">
                                                <i class="ki-solid ki-trash-square fs-1"></i>
                                            </button>
                                        </div>
                                    </div>


                                </span>

                                <div class="menu-sub menu-sub-accordion menu-active-bg">

                                    <div class="menu-item">
                                        <span class="menu-link"><span class="menu-bullet"><span class="bullet bullet-vertical"></span></span>
                                            <div class="menu-title d-flex justify-content-between">
                                                <div>Sub Category</div>
                                                <div>
                                                    <button class="btn btn-sm btn-icon btn-active-color-primary">
                                                        <i class="ki-solid ki-message-edit fs-1 "></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-icon  btn-active-color-danger">
                                                        <i class="ki-solid ki-trash-square fs-1"></i>
                                                    </button>
                                                </div>
                                            </div>


                                        </span>

                                    </div>
                                    <div class="menu-item">
                                        <span class="menu-link"><span class="menu-bullet"><span class="bullet bullet-vertical"></span></span>
                                            <div class="menu-title d-flex justify-content-between">
                                                <div>Sub Category</div>
                                                <div>
                                                    <button class="btn btn-sm btn-icon btn-active-color-primary">
                                                        <i class="ki-solid ki-message-edit fs-1 "></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-icon  btn-active-color-danger">
                                                        <i class="ki-solid ki-trash-square fs-1"></i>
                                                    </button>
                                                </div>
                                            </div>


                                        </span>

                                    </div>

                                </div>
                                <!--end:Menu sub-->
                            </div>
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->

                </div>
            </div>
        </div>

    </x-admin.layout.partials.content>

</div>
