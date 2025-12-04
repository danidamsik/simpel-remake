<!-- MODAL PREVIEW GAMBAR - STANDALONE COMPONENT -->
<div id="imagePreviewModal" class="fixed inset-0 z-[9999] overflow-y-auto hidden">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-black/90" onclick="closeImagePreview()"></div>

    <!-- Modal Content -->
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="bg-transparent w-full max-w-6xl">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <div class="text-white">
                    <p class="text-xl font-bold">Bukti Pembayaran</p>
                    <p class="text-sm text-gray-300" id="imageFileName">invoice.jpg</p>
                </div>
                <button onclick="closeImagePreview()"
                    class="p-3 bg-white/10 hover:bg-white/20 text-white rounded-full hover:rotate-90 transition-all duration-300">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Container Gambar -->
            <div class="bg-gray-900 rounded-xl overflow-hidden p-2">
                <div id="imageContainer" class="min-h-[400px] flex items-center justify-center">
                    <!-- Gambar akan dimuat di sini oleh JavaScript -->
                    <div class="text-center">
                        <i class="fas fa-image text-gray-400 text-5xl mb-4"></i>
                        <p class="text-gray-400 text-lg mb-2">Preview Gambar</p>
                        <p class="text-gray-500 text-sm">
                            Gambar akan dimuat di sini...
                        </p>
                    </div>
                </div>
            </div>

            <!-- Info Footer -->
            <div class="mt-4 flex justify-between items-center text-sm text-gray-300">
                <div>
                    <span class="flex items-center gap-2">
                        <i class="fas fa-expand-alt"></i>
                        <span id="imageDimensions">-</span>
                    </span>
                </div>
                <div class="flex gap-2">
                    <button onclick="rotateImage(-90)" class="p-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg">
                        <i class="fas fa-undo"></i>
                    </button>
                    <button onclick="rotateImage(90)" class="p-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg">
                        <i class="fas fa-redo"></i>
                    </button>
                    <button onclick="resetImage()" class="p-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Animasi untuk modal */
    #imagePreviewModal {
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    #imagePreviewModal:not(.hidden) {
        opacity: 1;
    }

    /* Styling untuk gambar */
    .preview-image {
        max-width: 100%;
        max-height: 75vh;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    /* Responsive */
    @media (max-width: 640px) {
        .preview-image {
            max-height: 60vh;
        }
    }
</style>

<script>
    // =============================================
    // VARIABEL GLOBAL
    // =============================================
    let currentRotation = 0;
    let currentImageUrl = '';

    // =============================================
    // FUNGSI UTAMA
    // =============================================

    /**
     * Fungsi untuk membuka modal preview gambar
     * @param {string} imageUrl - URL gambar yang akan ditampilkan
     * @param {string} fileName - Nama file (opsional)
     */
    function openImagePreview(imageUrl, fileName = '') {
        // Simpan URL gambar
        currentImageUrl = imageUrl;

        // Tampilkan modal
        const modal = document.getElementById('imagePreviewModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Set nama file jika ada
        if (fileName) {
            document.getElementById('imageFileName').textContent = fileName;
        }

        // Load gambar
        loadPreviewImage(imageUrl);
    }

    /**
     * Fungsi untuk menutup modal preview gambar
     */
    function closeImagePreview() {
        const modal = document.getElementById('imagePreviewModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';

        // Reset rotation
        currentRotation = 0;
    }

    /**
     * Fungsi untuk memuat gambar ke preview
     * @param {string} imageUrl - URL gambar
     */
    function loadPreviewImage(imageUrl) {
        const container = document.getElementById('imageContainer');

        // Kosongkan container
        container.innerHTML = '';

        // Buat elemen gambar
        const img = document.createElement('img');
        img.src = imageUrl;
        img.alt = "Bukti Pembayaran";
        img.className = "preview-image";
        img.id = "previewImage";
        img.style.transform = `rotate(${currentRotation}deg)`;

        // Handler saat gambar berhasil load
        img.onload = function() {
            // Update dimensi gambar
            document.getElementById('imageDimensions').textContent =
                `${this.naturalWidth} × ${this.naturalHeight}px`;

            // Auto-adjust untuk gambar portrait/landscape
            if (this.naturalWidth > this.naturalHeight) {
                // Landscape - pakai max-width
                this.style.maxWidth = '90%';
                this.style.height = 'auto';
            } else {
                // Portrait - pakai max-height
                this.style.width = 'auto';
                this.style.maxHeight = '75vh';
            }
        };

        // Handler jika gambar gagal load
        img.onerror = function() {
            container.innerHTML = `
            <div class="text-center p-8">
                <i class="fas fa-exclamation-triangle text-red-400 text-5xl mb-4"></i>
                <p class="text-red-400 text-lg mb-2">Gagal Memuat Gambar</p>
                <p class="text-gray-500 text-sm mb-4">URL: ${imageUrl}</p>
                <button onclick="retryLoadImage()" 
                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg">
                    <i class="fas fa-redo mr-2"></i>
                    Coba Lagi
                </button>
            </div>
        `;
        };

        // Tambahkan gambar ke container
        container.appendChild(img);
    }

    /**
     * Fungsi untuk memutar gambar
     * @param {number} degrees - Derajat rotasi (90 = clockwise, -90 = counter-clockwise)
     */
    function rotateImage(degrees) {
        currentRotation += degrees;
        const img = document.getElementById('previewImage');
        if (img) {
            img.style.transform = `rotate(${currentRotation}deg)`;
            img.style.transition = 'transform 0.3s ease';
        }
    }

    /**
     * Fungsi untuk mereset gambar ke keadaan awal
     */
    function resetImage() {
        currentRotation = 0;
        const img = document.getElementById('previewImage');
        if (img) {
            img.style.transform = `rotate(0deg)`;
            img.style.transition = 'transform 0.3s ease';

            // Reset size
            img.style.maxWidth = '';
            img.style.maxHeight = '';
            img.style.width = '';
            img.style.height = '';
        }
    }

    /**
     * Fungsi untuk mencoba load ulang gambar
     */
    function retryLoadImage() {
        if (currentImageUrl) {
            loadPreviewImage(currentImageUrl);
        }
    }

    // =============================================
    // EVENT LISTENERS
    // =============================================

    // Close modal dengan ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('imagePreviewModal');
            if (!modal.classList.contains('hidden')) {
                closeImagePreview();
            }
        }
    });

    // Close modal ketika klik overlay
    document.addEventListener('DOMContentLoaded', function() {
        const overlay = document.querySelector('#imagePreviewModal .fixed.inset-0');
        if (overlay) {
            overlay.addEventListener('click', closeImagePreview);
        }
    });

    // =============================================
    // EXPORT FUNGSI KE WINDOW OBJECT
    // =============================================
    window.openImagePreview = openImagePreview;
    window.closeImagePreview = closeImagePreview;
    window.rotateImage = rotateImage;
    window.resetImage = resetImage;
    window.retryLoadImage = retryLoadImage;
</script>
