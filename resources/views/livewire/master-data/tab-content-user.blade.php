<div x-show="activeTab === 'user'" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0">

    <div class="mb-6 flex justify-between items-end">
        <div>
            <h2 class="text-lg md:text-xl font-semibold text-gray-800 dark:text-gray-100">Data Bendahara</h2>
            <p class="text-gray-600 dark:text-gray-300 text-sm">Kelola akun bendahara seluruh lembaga</p>
        </div>
        <button
            @click="
                $wire.username = '';
                $wire.email = '';
                $wire.password = '';
                $wire.password_confirmation = '';
                $wire.profile = null;
                $wire.existingProfile = null;
                $wire.selectedUserId = null;
                $wire.isEditMode = false;
                $wire.showModal = true;
            "
            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm text-sm font-medium transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Bendahara
        </button>
    </div>

    <!-- Filter Section -->
    <div class="mb-4 flex flex-col sm:flex-row gap-3">
        <!-- Search Input -->
        <div class="w-full sm:w-64">
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" wire:model.live.debounce.300ms="search"
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all"
                    placeholder="Cari bendahara...">
            </div>
        </div>

        <!-- Filter Organization -->
        <div class="w-full sm:w-64">
            <select wire:model.live="filterOrganization"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                <option value="">Semua Lembaga</option>
                @foreach ($organizations as $org)
                    <option value="{{ $org->id }}">{{ $org->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Filter Period -->
        <div class="w-full sm:w-48">
            <select wire:model.live="filterPeriod"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                <option value="">Semua Periode</option>
                @foreach ($periods as $period)
                    <option value="{{ $period->id }}">{{ $period->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Table Data User -->
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Profil
                    </th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Username
                    </th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Email
                    </th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Lembaga
                    </th>
                    <th
                        class="py-3 px-4 text-right text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($users as $user)
                    @php
                        $colors = ['blue', 'green', 'purple', 'pink', 'indigo', 'teal', 'orange', 'red'];
                        $color = $colors[$loop->index % count($colors)];
                        $initials = strtoupper(substr($user->username, 0, 2));
                    @endphp
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <td class="py-3 px-4">
                            <div class="flex items-center">
                                @if ($user->profile_path)
                                    <img src="{{ asset('storage/' . $user->profile_path) }}" alt="{{ $user->username }}"
                                        class="h-10 w-10 rounded-full object-cover">
                                @else
                                    <div
                                        class="h-10 w-10 rounded-full bg-gradient-to-br from-{{ $color }}-500 to-{{ $color }}-600 flex items-center justify-center text-white font-medium">
                                        {{ $initials }}
                                    </div>
                                @endif
                            </div>
                        </td>

                        <td class="py-3 px-4">
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->username }}
                            </div>
                        </td>

                        <td class="py-3 px-4">
                            <div class="text-sm text-gray-900 dark:text-gray-100">{{ $user->email }}</div>
                        </td>

                        <td class="py-3 px-4">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $user->organizationUser->organization->name ?? '-' }}
                            </span>
                        </td>

                        <td class="py-3 px-4 text-right">
                            <button
                                @click="
                                    $wire.selectedUserId = {{ $user->id }};
                                    $wire.username = '{{ addslashes($user->username) }}';
                                    $wire.email = '{{ addslashes($user->email) }}';
                                    $wire.existingProfile = '{{ $user->profile_path }}';
                                    console.log($wire.existingProfile);
                                    $wire.profile = null;
                                    $wire.password = '';
                                    $wire.password_confirmation = '';
                                    $wire.isEditMode = true;
                                    $wire.showModal = true;
                                "
                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-12 h-12 text-gray-300 dark:text-gray-600" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                                <span>Belum ada data bendahara</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <x-global.pagination :paginator="$users" />
    @include('livewire.master-data.component.modal-form-user')
    @include('livewire.master-data.component.modal-credential-user')
</div>
