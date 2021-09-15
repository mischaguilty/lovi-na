<div class="nav-item" data-toggle="dropdown">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="locale" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $currentLocale ?? app()->getLocale() }}
        </a>
    <ul class="dropdown-menu" aria-labelledby="locale">
        @forelse(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li>
                <a rel="alternate" class="dropdown-item" hreflang="{{ $localeCode }}" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, [request()->query], true) }}">
                    {{ $properties['native'] }}
                </a>
            </li>
        @empty
            <li>{{ app()->getLocale() }}</li>
        @endforelse
    </ul>
    </li>
</div>
@push('scripts')
{{--    <script>--}}
{{--        window.addEventListener('paginationUpdated', function (data) {--}}
{{--            --}}
{{--        });--}}
{{--    </script>--}}
@endpush
