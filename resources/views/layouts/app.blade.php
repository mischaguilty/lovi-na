<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ $company->name ?? config('app.name') }}</title>

    <livewire:styles/>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            @livewire('logo', [
    'logo' => $company->getFirstMedia('logo') ?? null,
    ])
            <button type="button" data-bs-toggle="collapse" data-bs-target="#nav" class="navbar-toggler">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="nav" class="collapse navbar-collapse">
                <div class="navbar-nav ms-auto">
                    {!! (new \App\Components\LanguageSwitcher)->render()!!}
                @guest
                    @if(Route::has('login'))
                            <a href="{{ route('login') }}" class="nav-link">{{ __('Login') }}</a>
                            <a href="{{ route('register') }}" class="nav-link">{{ __('Register') }}</a>
                        @endif
                    @else
                        <div class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle">
                                <i class="fa fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('logout') }}" class="dropdown-item">{{ __('Logout') }}</a>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        {{ $slot }}
    </main>

    <livewire:scripts/>

    <script src="{{ mix('js/app.js') }}"></script>

@stack('scripts')
</body>
</html>
