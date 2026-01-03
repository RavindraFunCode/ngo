@if ($paginator->hasPages())
    <div class="border-bottom"></div><br>
    <ul class="page_pagination center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li><a href="#" class="tran3s disabled"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" class="tran3s"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li><a href="#" class="tran3s disabled">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><a href="#" class="active tran3s">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}" class="tran3s">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" class="tran3s"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
        @else
            <li><a href="#" class="tran3s disabled"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
        @endif
    </ul>
@endif
