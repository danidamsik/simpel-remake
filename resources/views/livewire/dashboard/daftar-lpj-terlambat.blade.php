<div class="bg-white dark:bg-gray-900 text-slate-900 dark:text-slate-100 p-4 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm"
    x-data="lpjTerlambatData()">
    
    @include('livewire.dashboard.component.notification-toast')

    <h3 class="text-lg font-semibold mb-4">Daftar LPJ Terlambat</h3>

    @if ($lpjTerlambat->isEmpty())
        <p class="text-slate-500 dark:text-slate-400">Tidak ada LPJ terlambat saat ini.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-700 text-sm text-black dark:text-white">
                        <th class="px-3 py-2 text-left">Kegiatan</th>
                        <th class="px-3 py-2 text-left">Organisasi</th>
                        <th class="px-3 py-2 text-left">Lembaga</th>
                        <th class="px-3 py-2 text-left">Tanggal Selesai</th>
                        <th class="px-3 py-2 text-left">Tenggat LPJ</th>
                        <th class="px-3 py-2 text-left">Terlambat</th>
                        <th class="px-3 py-2 text-left">Status</th>
                        <th class="px-3 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-xs">
                    @foreach ($lpjTerlambat as $item)
                        @php
                            $end = \Carbon\Carbon::parse($item->end_date);
                            $deadline = isset($item->deadline)
                                ? \Carbon\Carbon::parse($item->deadline)
                                : $end->copy()->addDays(7);

                            $days = $end->diffInDays(now());
                            $daysLate = now()->diffInDays($deadline, false);

                            $status = null;
                            $statusColor = '';

                            if ($days >= 14) {
                                $status = 'Perlu Tindakan';
                                $statusColor = 'text-red-600 dark:text-red-400';
                            } elseif ($days >= 7) {
                                $status = 'Peringatan';
                                $statusColor = 'text-yellow-600 dark:text-yellow-400';
                            }
                        @endphp

                        <tr
                            class="border-b border-slate-100 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                            <td class="px-3 py-2">{{ $item->activity_name }}</td>
                            <td class="px-3 py-2">{{ $item->name }}</td>
                            <td class="px-3 py-2">{{ $item->lembaga }}</td>

                            <td class="px-3 py-2">
                                {{ $end->format('d M Y') }}
                                <span class="text-xs text-slate-500 dark:text-slate-400">
                                    ({{ $days }} hari lalu)
                                </span>
                            </td>

                            <td class="px-3 py-2">{{ $deadline->format('d M Y') }}</td>

                            <td class="px-3 py-2">
                                @if ($daysLate < 0)
                                    <span class="text-red-600 dark:text-red-400 font-medium">
                                        {{ abs($daysLate) }} hari
                                    </span>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            
                            <td class="px-3 py-2 font-medium {{ $statusColor }}">
                                {{ $status ?? '-' }}
                            </td>

                            <td class="px-3 py-2">
                                <div class="relative" x-data="{ open: false }">
                                    <!-- Ellipsis Button -->
                                    <button @click="open = !open" @click.outside="open = false"
                                        class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div x-cloak x-show="open" x-transition
                                        class="absolute right-0 z-50 -mt-24 w-40 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1">

                                        <!-- Kirim Pesan -->
                                        <button
                                            @click="open = false; openMessageModal({
                                            activityId: {{ $item->activity_id }},
                                            activityName: '{{ addslashes($item->activity_name) }}',
                                            personResponsible: '{{ addslashes($item->person_responsible) }}',
                                            whatsappNumber: '{{ $item->number_pr }}',
                                            deadline: '{{ $deadline->format('d M Y') }}'
                                        })"
                                            class="w-full flex items-center gap-2 px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                            </svg>
                                            Kirim Pesan
                                        </button>

                                        <!-- Lihat Logs -->
                                        <button @click="open = false; openLogs({{ $item->activity_id }})"
                                            class="w-full flex items-center gap-2 px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Lihat Logs
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <!-- Modal Logs (Alpine.js driven) -->
    @include('livewire.dashboard.component.modal-logs')

    <!-- Modal Kirim Pesan (Alpine.js driven) -->
    @include('livewire.dashboard.component.modal-message')
</div>

@script
    <script>
        Alpine.data('lpjTerlambatData', () => ({
            // Modal Logs
            showModal: false,
            loading: false,
            activityName: '',
            logs: [],

            async openLogs(activityId) {
                this.loading = true;
                this.showModal = true;
                const result = await $wire.getLogs(activityId);
                this.activityName = result.activityName;
                this.logs = result.logs;
                this.loading = false;
            },

            closeModal() {
                this.showModal = false;
                this.activityName = '';
                this.logs = [];
            },

            // Modal Kirim Pesan
            showMessageModal: false,
            sending: false,
            messageData: {
                activityId: null,
                activityName: '',
                personResponsible: '',
                whatsappNumber: '',
                message: '',
                deadline: ''
            },

            openMessageModal(data) {
                this.messageData = {
                    activityId: data.activityId,
                    activityName: data.activityName,
                    personResponsible: data.personResponsible,
                    whatsappNumber: data.whatsappNumber,
                    deadline: data.deadline,
                    message: 'Halo ' + data.personResponsible +
                        ', kami mengingatkan bahwa LPJ untuk kegiatan "' + data.activityName +
                        '" belum diserahkan. Tenggat: ' + data.deadline
                };
                this.showMessageModal = true;
            },

            closeMessageModal() {
                this.showMessageModal = false;
                this.sending = false;
                this.messageData = {
                    activityId: null,
                    activityName: '',
                    personResponsible: '',
                    whatsappNumber: '',
                    message: '',
                    deadline: ''
                };
            },

            // Notification
            notification: {
                show: false,
                type: '', // 'success' or 'error'
                message: ''
            },

            showNotification(type, message) {
                this.notification = {
                    show: true,
                    type,
                    message
                };
                setTimeout(() => {
                    this.notification.show = false;
                }, 4000);
            },

            async sendWhatsApp() {
                this.sending = true;
                try {
                    const result = await $wire.sendMessage(
                        this.messageData.activityId,
                        this.messageData.whatsappNumber,
                        this.messageData.message
                    );

                    if (result.success) {
                        this.closeMessageModal();
                        this.showNotification('success', 'Pesan berhasil dikirim!');
                    } else {
                        this.showNotification('error', 'Gagal: ' + result.message);
                    }
                } catch (error) {
                    this.showNotification('error', 'Terjadi kesalahan: ' + error.message);
                } finally {
                    this.sending = false;
                }
            }
        }));
    </script>
@endscript
