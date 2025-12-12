@props(['paginator', 'onEachSide' => 2])

@if ($paginator->hasPages())
    <div {{ $attributes->merge(['class' => 'px-6 py-4 border-t border-gray-200 dark:border-gray-700']) }}>
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <!-- Info -->
            <div class="text-sm text-gray-600 dark:text-gray-400">
                Menampilkan
                <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $paginator->firstItem() ?? 0 }}</span>
                sampai
                <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $paginator->lastItem() ?? 0 }}</span>
                dari
                <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $paginator->total() }}</span>
                data
            </div>

            <!-- Pagination Buttons -->
            <div class="flex items-center gap-2">
                {{-- First Page --}}
                @if ($paginator->onFirstPage())
                    <button disabled
                        class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                                       bg-gray-100 dark:bg-gray-800 text-gray-400 dark:text-gray-600 cursor-not-allowed">
                        <i class="fas fa-angle-double-left"></i>
                    </button>
                @else
                    <button wire:click="gotoPage(1)"
                        class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                               bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300
                               hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <i class="fas fa-angle-double-left"></i>
                    </button>
                @endif

                {{-- Previous Page --}}
                @if ($paginator->onFirstPage())
                    <button disabled
                        class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                                       bg-gray-100 dark:bg-gray-800 text-gray-400 dark:text-gray-600 cursor-not-allowed">
                        <i class="fas fa-angle-left"></i>
                    </button>
                @else
                    <button wire:click="previousPage"
                        class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                               bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300
                               hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <i class="fas fa-angle-left"></i>
                    </button>
                @endif

                {{-- Page Numbers --}}
                @foreach ($paginator->getUrlRange(max(1, $paginator->currentPage() - $onEachSide), min($paginator->lastPage(), $paginator->currentPage() + $onEachSide)) as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button
                            class="px-4 py-2 text-sm rounded-lg font-semibold
                                  bg-blue-600 text-white shadow-sm">
                            {{ $page }}
                        </button>
                    @else
                        <button wire:click="gotoPage({{ $page }})"
                            class="px-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                                   bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300
                                   hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            {{ $page }}
                        </button>
                    @endif
                @endforeach

                {{-- Next Page --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage"
                        class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                               bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300
                               hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <i class="fas fa-angle-right"></i>
                    </button>
                @else
                    <button disabled
                        class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                                       bg-gray-100 dark:bg-gray-800 text-gray-400 dark:text-gray-600 cursor-not-allowed">
                        <i class="fas fa-angle-right"></i>
                    </button>
                @endif

                {{-- Last Page --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="gotoPage({{ $paginator->lastPage() }})"
                        class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                               bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300
                               hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <i class="fas fa-angle-double-right"></i>
                    </button>
                @else
                    <button disabled
                        class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                                       bg-gray-100 dark:bg-gray-800 text-gray-400 dark:text-gray-600 cursor-not-allowed">
                        <i class="fas fa-angle-double-right"></i>
                    </button>
                @endif
            </div>
        </div>
    </div>
@endif
