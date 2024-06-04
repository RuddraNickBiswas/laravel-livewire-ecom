<template x-teleport="body">
    <div
        x-dialog
        x-model="dialogOpen"
        style="display: none; z-index: 50000;"
        class="position-fixed top-0 start-0 w-100 h-100 overflow-auto text-start pt-50 pt-sm-0"
    >
        <!-- Overlay -->
        <div x-dialog:overlay x-transition:enter.opacity style="background-color: rgba(0, 0, 0, 0.25);" class="position-fixed top-0 start-0 w-100 h-100"></div>

        <!-- Panel -->
        <div class="d-flex justify-content-center align-items-end align-items-sm-center min-vh-100 p-0 p-sm-4">
            <div
                x-dialog:panel
                x-transition.in
                class="position-relative max-w-xl w-100 bg-white rounded-top-xl rounded-bottom-sm-xl shadow-lg overflow-hidden"
            >
                <!-- Mobile: Top "grab" handle... -->
                <div
                    class="d-sm-none position-absolute top-n10 start-0 end-0 h-50"
                    x-data="{ startY: 0, currentY: 0, moving: false, get distance() { return this.moving ? Math.max(0, this.currentY - this.startY) : 0 } }"
                    x-on:touchstart="moving = true; startY = currentY = $event.touches[0].clientY"
                    x-on:touchmove="currentY = $event.touches[0].clientY"
                    x-on:touchend="if (distance > 100) $dialog.close(); moving = false;"
                    x-effect="$el.parentElement.style.transform = 'translateY('+distance+'px)'"
                >
                    <div class="d-flex justify-content-center pt-2">
                        <div class="bg-gray-400 rounded w-10 h-1"></div>
                    </div>
                </div>

                <!-- Close Button -->
                <div class="position-absolute top-0 end-0 pt-4 pe-4">
                    <button type="button" x-on:click="$dialog.close()" class="bg-gray-50 rounded p-2 text-gray-600 focus-outline-none focus-visible-ring-2 focus-visible-ring-blue-500 focus-visible-ring-offset-2">
                        <span class="visually-hidden">Close modal</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <!-- Panel -->
                <div class="p-4">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</template>
