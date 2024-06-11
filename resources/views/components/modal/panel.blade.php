<template x-teleport="body">
    <div x-dialog
        x-model="dialogOpen"
        style="display: none; z-index: 500;"
        class="position-fixed top-0 start-0 w-100 h-100 overflow-x-hidden text-start pt-50 pt-sm-0">
        <!-- Overlay -->
        <div x-dialog:overlay
            x-transition:enter.opacity
            style="background-color: rgba(0, 0, 0, 0.25);"
            class="position-fixed top-0 start-0 w-100 h-100"></div>

        <!-- Panel -->
        <div >

            <div class=" mx-auto d-flex justify-content-center align-items-end align-items-sm-center min-vh-100 p-0 p-sm-4">
                <div x-dialog:panel
                    x-transition.in
                    class="position-relative  bg-body  rounded  shadow-lg overflow-hidden">
                    <!-- Mobile: Top "grab" handle... -->
                    <div class="d-sm-none position-absolute top-n10 start-0 end-0 z-2"
                        style="height: 5rem"
                        x-data="{ startY: 0, currentY: 0, moving: false, get distance() { return this.moving ? Math.max(0, this.currentY - this.startY) : 0 } }"
                        x-on:touchstart="moving = true; startY = currentY = $event.touches[0].clientY"
                        x-on:touchmove="currentY = $event.touches[0].clientY"
                        x-on:touchend="if (distance > 100) $dialog.close(); moving = false;"
                        x-effect="$el.parentElement.style.transform = 'translateY('+distance+'px)'">
                        <div class="d-flex justify-content-center pt-2">
                            <div class="bg-gray-400 rounded w-10 h-1"></div>
                        </div>
                    </div>

                    <!-- Close Button -->
                    {{-- <div class="position-absolute top-0 end-0 pt-4 pe-4"
                    style="z-index: 600"
                    >

                        <button type="button" x-on:click="$dialog.close()" class="btn btn-close btn-link  waves-effect ">
                          </button>
                    </div> --}}
                    {{-- <div class="modal-header pb-0 border-0 justify-content-end">

                        <div x-on:click="$dialog.close()" class="btn btn-sm btn-icon btn-active-color-primary">
                            <x-modal.icon.close  class="fs-1 fw-bold " style="scale: 0.6 ;"/>
                        </div>

                    </div> --}}

                    <!-- Panel -->
                    <div class="p-4">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
