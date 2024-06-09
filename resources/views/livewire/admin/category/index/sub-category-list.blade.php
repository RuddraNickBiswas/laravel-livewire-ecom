<div class="menu-sub menu-sub-accordion menu-active-bg">

    @foreach ($subCategories as $subCategory)
        <div class="menu-item">
            <livewire:admin.category.index.sub-category-list-item  :category="$category" :subCategory="$subCategory" key="{{ $subCategory->id }} {{ $subCategory->name }} sub-category-list" />
        </div>
    @endforeach
</div>
