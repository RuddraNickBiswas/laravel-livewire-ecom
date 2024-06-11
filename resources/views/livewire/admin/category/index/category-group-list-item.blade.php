<div>
    <div id="#kt_app_sidebar_menu"
        class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-3 mb-5">
        <div class="menu-item menu-accordion show">
            <span class="menu-link">
                <span class="menu-bullet">
                    <span class="bullet bullet-vertical bg-danger"></span>
                </span>
                <div class="menu-title d-flex justify-content-between">
                    <div>{{ $categoryGroup->name }}</div>
                    <div class="d-flex">

                        <x-admin.pages.category.modal title='Add Category For {{ $categoryGroup->name }}'
                            showModal="showCreateModal"
                            submitAction='createCategory'>
                            <button wire:click='createModal'
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Create category for this group"
                                class="btn btn-sm btn-icon btn-active-color-success">
                                <i class="ki-solid ki-add-item fs-1"></i>
                            </button>
                        </x-admin.pages.category.modal>

                        <x-admin.pages.category.modal title='Edit Category Group'
                            showModal="showEditModal"
                            submitAction='save'>
                            <button wire:click='editModal'
                                class="btn btn-sm btn-icon btn-active-color-primary">
                                <i class="ki-solid ki-message-edit fs-1 "></i>
                            </button>
                        </x-admin.pages.category.modal>

                        <x-modal.delete-modal title="Delete Category Group {{ $categoryGroup->name }}"
                            showModal="showDeleteModal"
                            submitAction='delete({{ $categoryGroup->id }})'>
                            <button class="btn btn-sm btn-icon  btn-active-color-danger">
                                <i class="ki-solid ki-trash-square fs-1"></i>
                            </button>
                        </x-modal.delete-modal>
                    </div>
                </div>


            </span>

            <livewire:admin.category.index.category-list  :categoryGroup="$categoryGroup" key="{{ $categoryGroup->id }} {{ $categoryGroup->name }}" />

        </div>
        <!--end:Menu item-->

    </div>
</div>
