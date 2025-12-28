<div class="max-w-4xl mx-auto">
    <div class="bg-white dark:bg-slate-800 shadow rounded-lg overflow-hidden">
        <form wire:submit="save" class="p-6 space-y-6">
            <!-- Profile Photo -->
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Photo</label>
                <div class="flex items-center gap-4" x-data="{ photoName: null, photoPreview: null, isUploading: false }"
                    x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div class="relative h-20 w-20">
                        <!-- Current Photo -->
                        <div x-show="!photoPreview || isUploading">
                            @if ($profile_path)
                                <img src="{{ asset('storage/' . $profile_path) }}" alt="{{ $username }}"
                                    class="h-20 w-20 rounded-full object-cover border-2 border-slate-200 dark:border-slate-600">
                            @else
                                <div
                                    class="h-20 w-20 rounded-full bg-indigo-100 dark:bg-slate-700 flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-2xl border-2 border-slate-200 dark:border-slate-600">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>

                        <!-- New Photo Preview -->
                        <div x-show="photoPreview && !isUploading" style="display: none;">
                            <span
                                class="block h-20 w-20 rounded-full bg-cover bg-no-repeat bg-center border-2 border-indigo-500"
                                x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>

                        <!-- Loading Indicator Overlay -->
                        <div x-show="isUploading" style="display: none;"
                            class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-full z-10 transition-opacity">
                            <i class="fas fa-spinner fa-spin text-white"></i>
                        </div>
                    </div>

                    <!-- File Input & Button -->

                    <input type="file" wire:model="photo" id="photo" class="hidden" x-ref="photo"
                        x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                            " />

                    <button type="button"
                        class="inline-flex items-center px-4 py-2 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-md font-semibold text-xs text-slate-700 dark:text-slate-200 uppercase tracking-widest shadow-sm hover:bg-slate-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all"
                        x-on:click.prevent="$refs.photo.click()">
                        <i class="fas fa-camera mr-2"></i> Change Photo
                    </button>

                </div>
                @error('photo')
                    <span class="text-red-500 text-xs block mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Username -->
                <div class="col-span-1">
                    <label for="username"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Username</label>
                    <input type="text" wire:model="username" id="username"
                        class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2.5 border">
                    @error('username')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-span-1">
                    <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email
                        Address</label>
                    <input type="email" wire:model="email" id="email"
                        class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2.5 border">
                    @error('email')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Password Section -->
            <div class="border-t border-slate-200 dark:border-slate-700 pt-6">
                <h4 class="text-md font-medium text-slate-800 dark:text-slate-200 mb-4">Change Password</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-1">
                        <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">New
                            Password</label>
                        <input type="password" wire:model="password" id="password" autocomplete="new-password"
                            placeholder="Leave blank to keep current"
                            class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2.5 border">
                        @error('password')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-1">
                        <label for="password_confirmation"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300">Confirm
                            Password</label>
                        <input type="password" wire:model="password_confirmation" id="password_confirmation"
                            autocomplete="new-password"
                            class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2.5 border">
                    </div>
                </div>
            </div>

            <!-- Role (Read Only) -->
            <div class="border-t border-slate-200 dark:border-slate-700 pt-6">
                <div class="w-full md:w-1/2">
                    <label for="role"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Role</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-shield-alt text-slate-400"></i>
                        </div>
                        <input type="text" wire:model="role" id="role" disabled
                            class="block w-full pl-10 sm:text-sm border-slate-300 dark:border-slate-600 rounded-md bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 cursor-not-allowed p-2.5 border">
                    </div>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Role cannot be changed.</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end border-t border-slate-200 dark:border-slate-700 pt-6">
                <div x-data="{ shown: false, timeout: null }" x-init="@this.on('profile-updated', () => {
                    clearTimeout(timeout);
                    shown = true;
                    timeout = setTimeout(() => { shown = false }, 2000);
                })"
                    x-show.transition.out.opacity.duration.1500ms="shown" x-transition:leave.opacity.duration.1500ms
                    style="display: none;"
                    class="text-sm text-green-600 dark:text-green-400 mr-4 font-medium flex items-center">
                    <i class="fas fa-check-circle mr-1"></i> Saved successfully.
                </div>

                <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => {
                    clearTimeout(timeout);
                    shown = true;
                    timeout = setTimeout(() => { shown = false }, 2000);
                })"
                    x-show.transition.out.opacity.duration.1500ms="shown" style="display: none;"
                    class="text-sm text-green-600 dark:text-green-400 mr-4">
                    Saved.
                </div>

                <button type="submit" wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all disabled:opacity-50 disabled:cursor-wait">
                    <span wire:loading.remove>Save Changes</span>
                    <span wire:loading><i class="fas fa-spinner fa-spin mr-2"></i> Saving...</span>
                </button>
            </div>
        </form>
    </div>
</div>
