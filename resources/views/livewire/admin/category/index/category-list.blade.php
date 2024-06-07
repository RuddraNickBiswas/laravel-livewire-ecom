<span class="menu-link"><span class="menu-bullet"><span class="bullet bullet-vertical bg-warning"></span></span>
    <div class="menu-title d-flex justify-content-between">
        <div>{{ $category->name }}</div>
        <div class="d-flex">
            <x-admin.pages.category.modal title='Add Sub Category For {{ $category->name }}'
                showModal="showCreateModal"
                submitAction='createSubCategory'>
                <button wire:click='createModal'
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Create sub category for this category"
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

            <x-modal.delete-modal title="Delete Category {{ $category->name }}"
                showModal="showDeleteModal"
                submitAction='delete({{ $category->id }})'>
                <button class="btn btn-sm btn-icon  btn-active-color-danger">
                    <i class="ki-solid ki-trash-square fs-1"></i>
                </button>
            </x-modal.delete-modal>
        </div>
    </div>
</span>
