<span class="menu-link"><span class="menu-bullet"><span class="bullet bullet-vertical bg-success"></span></span>
    <div class="menu-title d-flex justify-content-between">
        <div>{{ $subCategory->name }}</div>
        <div class="d-flex">
            <x-admin.pages.category.modal title='Edit Sub Category'
                showModal="showEditModal"
                submitAction='save'>
                <button wire:click='editModal'
                    class="btn btn-sm btn-icon btn-active-color-primary">
                    <i class="ki-solid ki-message-edit fs-1 "></i>
                </button>
            </x-admin.pages.category.modal>

            <x-modal.delete-modal title="Delete Sub Category {{ $subCategory->name }}"
                showModal="showDeleteModal"
                submitAction='delete({{ $subCategory->id }})'>
                <button class="btn btn-sm btn-icon  btn-active-color-danger">
                    <i class="ki-solid ki-trash-square fs-1"></i>
                </button>
            </x-modal.delete-modal>
        </div>
    </div>
</span>
