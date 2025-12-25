<div x-show="$wire.showCredentialModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
    role="dialog" aria-modal="true">

    <!-- Background overlay -->
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="$wire.showCredentialModal" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-80"
            @click="$wire.showCredentialModal = false">
        </div>

        <!-- Center modal -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal panel -->
        <div x-show="$wire.showCredentialModal" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white dark:bg-gray-800 shadow-xl rounded-2xl">

            <div class="text-center mb-6">
                <div
                    class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 dark:bg-green-900 mb-4">
                    <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                    Akun Berhasil Disimpan
                </h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Silakan simpan informasi login berikut.
                </p>
            </div>

            <div class="space-y-4 mb-6" x-data="{
                copied: false,
                copyToClipboard(text) {
                    if (navigator.clipboard && window.isSecureContext) {
                        navigator.clipboard.writeText(text).then(() => {
                            this.copied = true;
                            setTimeout(() => this.copied = false, 2000);
                        });
                    } else {
                        // Fallback for older browsers
                        let textArea = document.createElement('textarea');
                        textArea.value = text;
                        textArea.style.position = 'fixed';
                        textArea.style.left = '-9999px';
                        document.body.appendChild(textArea);
                        textArea.focus();
                        textArea.select();
                        try {
                            document.execCommand('copy');
                            this.copied = true;
                            setTimeout(() => this.copied = false, 2000);
                        } catch (err) {
                            console.error('Failed to copy', err);
                        }
                        document.body.removeChild(textArea);
                    }
                }
            }">

                <!-- Username -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Username</label>
                    <div class="flex rounded-md shadow-sm">
                        <input type="text" readonly value="{{ $createdUsername }}" x-ref="usernameInput"
                            class="flex-1 min-w-0 block w-full px-3 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 sm:text-sm focus:ring-0 focus:border-gray-300">
                        <button type="button" @click="copyToClipboard($refs.usernameInput.value)"
                            class="inline-flex items-center px-4 py-2 border border-l-0 border-gray-300 dark:border-gray-600 rounded-r-md bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                    <div class="flex rounded-md shadow-sm">
                        <input type="text" readonly value="{{ $createdPassword }}" x-ref="passwordInput"
                            class="flex-1 min-w-0 block w-full px-3 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 sm:text-sm focus:ring-0 focus:border-gray-300">
                        <button type="button" @click="copyToClipboard($refs.passwordInput.value)"
                            class="inline-flex items-center px-4 py-2 border border-l-0 border-gray-300 dark:border-gray-600 rounded-r-md bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Copy All Message -->
                <div x-show="copied" x-transition
                    class="text-center text-sm text-green-600 dark:text-green-400 font-medium">
                    Berhasil disalin!
                </div>
            </div>

            <!-- WhatsApp Notification Section -->
            <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-4">
                <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-3">Kirim ke WhatsApp</h4>
                <div class="flex gap-2">
                    <div class="flex-1">
                        <label for="whatsapp_number" class="sr-only">Nomor WhatsApp</label>
                        <input type="text" wire:model="whatsappNumber" id="whatsapp_number"
                            class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm px-3 py-2"
                            placeholder="Contoh: 08123456789">
                        @error('whatsappNumber')
                            <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="button" wire:click="sendCredentialToWhatsapp" wire:loading.attr="disabled"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed h-10">
                        <span wire:loading.remove wire:target="sendCredentialToWhatsapp" class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                            Kirim
                        </span>
                        <span wire:loading wire:target="sendCredentialToWhatsapp" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Kirim...
                        </span>
                    </button>
                </div>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Masukkan nomor WhatsApp Bendahara untuk mengirim info login.
                </p>
            </div>

            <div class="mt-5 sm:mt-6">
                <button type="button" @click="$wire.showCredentialModal = false"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
