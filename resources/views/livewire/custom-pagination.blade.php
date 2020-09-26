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
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
            </button>
        @else
            <button class="" wire:click="previousPage" rel="prev" aria-label="@lang('pagination.previous')">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
            </button>
        @endif
        <p>Page {{ $paginator->currentPage() }}</p>
        @if ($paginator->hasMorePages())
            <button class="" wire:click="nextPage" rel="next" aria-label="@lang('pagination.next')">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            </button>
        @else
            <button class="text-gray-300 cursor-default" aria-disabled="true" aria-label="@lang('pagination.next')">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            </button>
        @endif
    </ul>
@endif