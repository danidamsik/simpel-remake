<div x-show="activeTab === 'user'" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0">

    <div class="mb-6">
        <h2 class="text-lg md:text-xl font-semibold text-gray-800 dark:text-gray-100">Data Bendahara</h2>
        <p class="text-gray-600 dark:text-gray-300 text-sm">Kelola akun bendahara seluruh lembaga</p>
    </div>

    <!-- Filter Section -->
    <div class="mb-4 flex flex-col sm:flex-row gap-3">
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
                                    <img src="{{ asset('storage/profile/' . $user->profile_path) }}"
                                        alt="{{ $user->username }}" class="h-10 w-10 rounded-full object-cover">
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
                            @forelse($user->organization as $org)
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ $org->name }}{{ !$loop->last ? ',' : '' }}
                                </span>
                            @empty
                                <span class="text-gray-400 text-sm">-</span>
                            @endforelse
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
</div>
