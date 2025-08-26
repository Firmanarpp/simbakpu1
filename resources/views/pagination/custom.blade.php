{{--
/**
 * Custom Pagination Component - Komponen Pagination Kustom
 * 
 * File: resources/views/pagination/custom.blade.php
 * Deskripsi: Template pagination kustom dengan Bootstrap styling
 * Fitur: Responsive design, FontAwesome icons, accessible navigation
 * 
 * Komponen yang ditampilkan:
 * - Previous/Next navigation dengan icons
 * - Page numbers dengan ellipsis untuk long pagination
 * - Responsive text (sembunyikan text di mobile)
 * - Accessible ARIA labels
 * - Bootstrap pagination styling
 * 
 * @author Sistem Manajemen Barang KPU
 * @version 1.0
 * @since August 2025
 */
--}}
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="fas fa-chevron-left"></i>
                        <span class="d-none d-sm-inline ms-1">Previous</span>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-chevron-left"></i>
                        <span class="d-none d-sm-inline ms-1">Previous</span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <span class="d-none d-sm-inline me-1">Next</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">
                        <span class="d-none d-sm-inline me-1">Next</span>
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
