<div>
    <a href="{{ route('welcome') }}" class="navbar-brand">
        @if($logo = $company->getFirstMedia('logo'))
            <img src="{{ $logo->getFullUrl() }}" alt="{{ $logo->name }}" height="32" width="auto"/>
        @endif
        {{ $company->name ?? config('app.name') }}
    </a>
</div>
