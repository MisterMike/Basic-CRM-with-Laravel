<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CRM') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-address-book text-primary"></i> {{ config('app.name', 'CRM') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a id="companiesDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('messages.memberships') }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="companiesDropdown">
                                <a class="dropdown-item" href="{{ route('memberships') }}">
                                    <i class="fas fa-list"></i> {{ __('messages.list') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('membership.create') }}">
                                    <i class="fas fa-plus"></i> {{ __('messages.add') }}
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="companiesDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('messages.members') }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="companiesDropdown">
                                <a class="dropdown-item" href="{{ route('members') }}">
                                    <i class="fas fa-list"></i> {{ __('messages.list') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('member.create') }}">
                                    <i class="fas fa-plus"></i> {{ __('messages.add') }}
                                </a>
                            </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                            </li>
{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('messages.register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
                        @else
                            @php $locale = session()->get('locale'); @endphp
                            <!-- Language Links -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @switch($locale)
                                        @case('en')
                                        {{ __('messages.english') }} <span class="caret"></span>
                                        @break
                                        @case('de')
                                        {{ __('messages.german') }} <span class="caret"></span>
                                        @break
                                        @default
                                        {{ __('messages.language') }} <span class="caret"></span>
                                    @endswitch
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="home/en"><i class="fas fa-globe"></i> {{ __('messages.english') }}</a>
                                    <a class="dropdown-item" href="home/de"><i class="fas fa-globe"></i> {{ __('messages.german') }}</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->isAdministrator())
                                        <a class="dropdown-item" href="{{ route('users') }}">
                                            <i class="fas fa-users"></i> {{ __('messages.users') }}
                                        </a>
                                        <div class="dropdown-divider"></div>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('messages.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="text-center my-4">
            Simple CRM, 2019 @ {{ __('messages.all_rights_reserved') }}
        </footer>
    </div>
</body>
</html>
