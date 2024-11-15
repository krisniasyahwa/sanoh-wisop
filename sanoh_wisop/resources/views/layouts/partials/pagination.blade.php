@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between mt-4 space-x-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-2 py-2 text-sm text-blue-500 bg-white border border-blue-950 rounded-md">
                <img src="{{ asset('images/icon/icon_left.png') }}" alt="Previous Icon" class="w-4 h-4">
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-2 py-2 text-sm text-blue-700 bg-white border border-blue-950 rounded-md hover:bg-blue-100">
                <img src="{{ asset('images/icon/icon_left.png') }}" alt="Previous Icon" class="w-4 h-4">
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="flex items-center space-x-1">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-2 text-sm text-blue-500">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="px-3 py-2 text-sm font-semibold text-white bg-blue-950 border border-blue-950 rounded-md">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                                class="px-3 py-2 text-sm text-blue-950 bg-white border border-blue-950 rounded-md hover:bg-blue-100">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="px-2 py-2 text-sm text-blue-700 bg-white border border-blue-950 rounded-md hover:bg-blue-100">
                <img src="{{ asset('images/icon/icon_right.png') }}" alt="Next Icon" class="w-4 h-4">
            </a>
        @else
            <span class="px-2 py-2 text-sm text-blue-500 bg-white border border-blue-950 rounded-md">
                <img src="{{ asset('images/icon/icon_right.png') }}" alt="Next Icon" class="w-4 h-4">
            </span>
        @endif
    </nav>
@endif
