@if ($paginator->hasPages())
    <ul class="flex items-center sticky bottom-0 bg-gray-100 border-t border-gray-200 p-2 md:p-3" role="navigation">
        <p class="text-sm text-gray-900 flex-grow">
            <span>Showing</span>
            <span class="font-bold">{{ $paginator->firstItem() }}</span>
            <span>to</span>
            <span class="font-bold">{{ $paginator->lastItem() }}</span>
            <span>of</span>
            <span class="font-bold">{{ $paginator->total() }}</span>
            <span>results</span>
        </p>
        @if ($paginator->onFirstPage())
            <button class="text-gray-300 cursor-default" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z" />
                </svg>
            </button>
        @else
            <button class="" wire:click="previousPage" rel="prev" aria-label="@lang('pagination.previous')">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z" />
                </svg>
            </button>
        @endif
        <p>Page {{ $paginator->currentPage() }}</p>
        @if ($paginator->hasMorePages())
            <button class="" wire:click="nextPage" rel="next" aria-label="@lang('pagination.next')">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                </svg>
            </button>
        @else
            <button class="text-gray-300 cursor-default" aria-disabled="true" aria-label="@lang('pagination.next')">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                </svg>
            </button>
        @endif
    </ul>
@endif