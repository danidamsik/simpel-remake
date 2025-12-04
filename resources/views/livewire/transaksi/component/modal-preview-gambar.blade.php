<div x-data="imagePreview()" 
     @open-image-preview.window="showModal($event.detail)"
     x-cloak
     x-show="open"
     style="display: none;"
     class="fixed inset-0 z-[99999]">
    
    <!-- Overlay -->
    <div x-show="open" 
         @click="closeModal()" 
         class="fixed inset-0 bg-black/90">
    </div>
    
    <!-- Modal -->
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div x-show="open" class="relative w-full max-w-6xl">
            
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <div class="text-white">
                    <p class="text-xl font-bold">Bukti Pembayaran</p>
                    <p class="text-sm text-gray-300" x-text="filename"></p>
                </div>
                <button @click="closeModal()"
                    class="p-3 bg-white/10 hover:bg-white/20 text-white rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Image Container -->
            <div class="bg-gray-900 rounded-xl overflow-hidden p-2">
                <div class="min-h-[400px] flex items-center justify-center">
                    <img x-show="imageUrl" 
                         :src="imageUrl" 
                         :style="{ transform: `rotate(${rotation}deg)` }"
                         class="max-w-full max-h-[75vh] object-contain"
                         alt="Bukti Pembayaran">
                         
                    <div x-show="!imageUrl" class="text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-gray-400 text-lg">Gambar tidak tersedia</p>
                    </div>
                </div>
            </div>
            
            <!-- Controls -->
            <div class="mt-4 flex justify-end gap-2">
                <button @click="rotateImage(-90)" 
                        class="p-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                    </svg>
                </button>
                <button @click="rotateImage(90)" 
                        class="p-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10h-10a8 8 0 00-8 8v2M21 10l-6 6m6-6l-6-6" />
                    </svg>
                </button>
                <button @click="resetRotation()" 
                        class="p-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('imagePreview', () => ({
        open: false,
        imageUrl: '',
        filename: '',
        rotation: 0,
        
        showModal(data) {
            this.imageUrl = data.imageUrl || '';
            this.filename = data.fileName || 'bukti.jpg';
            this.open = true;
            this.rotation = 0;
            document.body.style.overflow = 'hidden';
        },
        
        closeModal() {
            this.open = false;
            document.body.style.overflow = 'auto';
        },
        
        rotateImage(degrees) {
            this.rotation += degrees;
        },
        
        resetRotation() {
            this.rotation = 0;
        }
    }));
});
</script>