<div class="menu-sub menu-sub-accordion">

    @foreach ($categories as $category)
        <div class="menu-item menu-accordion show">
            {{-- category --}}
            <livewire:admin.category.index.category-list-item  :category=$category
                key="{{ $category->id }} {{ $category->name }} category-list-item" />

            {{-- category --}}

            <livewire:admin.category.index.sub-category-list :category="$category" key="{{ $category->id }} sub-categiry-list"/>

        </div>
    @endforeach
</div>
<!--end:Menu sub-->
