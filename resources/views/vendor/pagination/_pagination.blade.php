@if ($products->hasPages())
    @php
        $current = $products->currentPage();
        $last = $products->lastPage();
        $start = max(1, $current - 2);
        $end = min($last, $current + 2);
    @endphp

    <ul class="pagination">
        @if ($current == 1)
            <li><span class="page-link">&laquo;</span></li>
        @else
            <li><a href="javascript:void(0)" class="page-link" data-page="{{ $current - 1 }}">&laquo;</a></li>
        @endif

        @if ($start > 1)
            <li><a href="javascript:void(0)" class="page-link" data-page="1">1</a></li>
            @if ($start > 2)
                <li><span class="page-link">…</span></li>
            @endif
        @endif

        @for ($page = $start; $page <= $end; $page++)
            @if ($page == $current)
                <li><span class="page-link active">{{ $page }}</span></li>
            @else
                <li><a href="javascript:void(0)" class="page-link"
                        data-page="{{ $page }}">{{ $page }}</a></li>
            @endif
        @endfor

        @if ($end < $last)
            @if ($end < $last - 1)
                <li><span class="page-link">…</span></li>
            @endif
            <li><a href="javascript:void(0)" class="page-link" data-page="{{ $last }}">{{ $last }}</a>
            </li>
        @endif

        @if ($current < $last)
            <li><a href="javascript:void(0)" class="page-link" data-page="{{ $current + 1 }}">&raquo;</a></li>
        @else
            <li><span class="page-link">&raquo;</span></li>
        @endif
    </ul>
@endif
