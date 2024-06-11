<div wire:loading.save.class="opacity-25" >
    <x-admin.layout.partials.toolbar :title=$title
    :breadcrumbs=$breadcrumbs>
    <x-admin.layout.partials.toolbar.action>
        <x-admin.pages.category.modal title="Create Category Group" showModal="showModal"  submitAction='save'>
            <button class="btn btn-primary fs-7 fw-bold">Create</button>
        </x-admin.pages.category.modal>
    </x-admin.layout.partials.toolbar.action>
</x-admin.layout.partials.toolbar>


<x-admin.layout.partials.content>
        <input wire:model.live="search" type="text" class="form-control" placeholder="Search...">
        @foreach ($categoryGroups as $categoryGroup)
            <livewire:admin.category.index.category-group-list-item  :categoryGroup='$categoryGroup'
                key="{{ $categoryGroup->id }} {{ $categoryGroup->name }} category-group-list-item" />
        @endforeach

    </x-admin.layout.partials.content>

</div>


