
@if ($paginator->hasPages())

    <div class="pagination-li {{isset($class) ? $class : null}}">
        <div class="d-flex flex-wrap py-2 mr-3 ">
            @if ($paginator->onFirstPage())
                {{-- <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled"><i class="ki ki-bold-double-arrow-next icon-xs"></i></a> --}}
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-arrow-next icon-xs"></i></a>
            @else
                {{-- <a href="{{ $paginator->url(1) }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled"><i class="ki ki-bold-double-arrow-next icon-xs"></i></a> --}}
                <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-arrow-next icon-xs"></i></a>
            @endif
                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="opacity" aria-disabled="true">
                            <a href="javascript:void(0);" class="btn btn-icon btn-sm border bg-white btn-hover-primary mr-2 my-1">{{ $element }}</a>
                        </li>
                    @endif
        
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active" aria-current="page">
                                    <a href="{{ $url }}" class="btn btn-icon btn-sm border bg-white btn-hover-primary active mr-2 my-1">{{ $page }}</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}" class="btn btn-icon btn-sm border bg-white btn-hover-primary mr-2 my-1">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach


        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
            {{-- <a href="{{ $paginator->url($paginator->lastPage()) }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled"><i class="ki ki-bold-double-arrow-back icon-xs"></i></a> --}}
        @else
            <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
            {{-- <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled"><i class="ki ki-bold-double-arrow-back icon-xs"></i></a> --}}
        @endif

        </div>
    </div>

@endif
