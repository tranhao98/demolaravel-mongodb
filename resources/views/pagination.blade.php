@if ($paginator->hasPages())
    <ul class="pagination modal-6">

        @if ($paginator->onFirstPage())
            <li><a class="prev">&laquo</a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" class="prev">&laquo</a></li>
        @endif
        @if (is_array($elements[0]))
            @foreach ($elements[0] as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li><a href="{{ $url }}" class="active">{{ $page }}</a></li>

                @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif

            @endforeach
        @endif
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" class="next">&raquo;</a></li>
        @else
            <li><a class="next">&raquo;</a></li>
        @endif
    </ul>
@endif
