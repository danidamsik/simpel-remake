<div x-show="showImageModal" x-cloak @click="closeImageModal()" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[60] overflow-y-auto bg-black bg-opacity-90 flex items-center justify-center p-4"
    aria-labelledby="image-modal" role="dialog" aria-modal="true">

    <div class="relative max-w-7xl w-full">
        <!-- Close Button -->
        <button @click="closeImageModal()" type="button"
            class="absolute top-4 right-4 z-10 p-2 bg-black bg-opacity-50 hover:bg-opacity-70 text-white rounded-full transition-all duration-200">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Download Button -->
        <a :href="imageUrl" download target="_blank"
            class="absolute top-4 left-4 z-10 p-2 bg-black bg-opacity-50 hover:bg-opacity-70 text-white rounded-full transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
        </a>

        <!-- Image -->
        <div @click.stop class="flex items-center justify-center">
            <img :src="imageUrl" alt="Bukti Pengeluaran"
                class="max-h-[85vh] w-auto rounded-lg shadow-2xl object-contain"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100">
        </div>

        <!-- Image Info -->
        <div class="text-center mt-4">
            <p class="text-white text-sm">Klik di luar gambar atau tombol X untuk menutup</p>
        </div>
    </div>
</div>
