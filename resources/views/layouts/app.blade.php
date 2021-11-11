<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Printerous') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 301.3 59.93" width="148"><defs><style>.cls-1{fill:#1f4ee5;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path d="M93.26,8.42A14.58,14.58,0,0,0,78.68,23V42.25h6.26V23h0a8.32,8.32,0,0,1,16.63,0h0V42.25h6.26V23A14.57,14.57,0,0,0,93.26,8.42Z"></path><path d="M255.55,43.09a14.58,14.58,0,0,0,14.58-14.58V9.26h-6.27V28.51h0a8.31,8.31,0,1,1-16.62,0h0V9.26H241V28.51A14.58,14.58,0,0,0,255.55,43.09Z"></path><circle class="cls-1" cx="3.74" cy="20.59" r="3.74"></circle><path d="M25.12,8.42A14.57,14.57,0,0,0,10.55,23V33.4a13.79,13.79,0,0,1-3.46-4.61H.39A20.15,20.15,0,0,0,10.55,40.91v19h6.26V42.87A20.06,20.06,0,0,0,39.7,23,14.58,14.58,0,0,0,25.12,8.42Zm7,20.37a13.79,13.79,0,0,1-15.34,7.74V23h0a8.32,8.32,0,0,1,16.63,0h0A13.71,13.71,0,0,1,32.15,28.79Z"></path><rect x="66.61" y="9.26" width="6.27" height="32.99"></rect><path d="M125.16,0H118.9V9.26h-7.24v5.43h7.24V31.88c0,1.35.06,2.68.17,4a8.46,8.46,0,0,0,1.12,3.59,6.81,6.81,0,0,0,2.92,2.61,12.62,12.62,0,0,0,5.6,1,20.52,20.52,0,0,0,2.75-.25,8,8,0,0,0,2.89-.87V36.26a6.47,6.47,0,0,1-2.16.77,13.09,13.09,0,0,1-2.29.21,4.75,4.75,0,0,1-2.75-.66,3.9,3.9,0,0,1-1.39-1.74,7.1,7.1,0,0,1-.53-2.44c0-.9-.07-1.82-.07-2.75v-15h9.19V9.26h-9.19Z"></path><path d="M300.57,28.82a7.93,7.93,0,0,0-2-2.72,10.72,10.72,0,0,0-3.06-1.81,30.61,30.61,0,0,0-3.79-1.18l-2.51-.49a12.91,12.91,0,0,1-2.75-.83,7.49,7.49,0,0,1-2.23-1.46,3.19,3.19,0,0,1-.94-2.37,3,3,0,0,1,1.64-2.75,7.59,7.59,0,0,1,3.86-.94,7.87,7.87,0,0,1,4,.94,9.31,9.31,0,0,1,2.75,2.33l4.88-3.69a10.09,10.09,0,0,0-4.88-4.17,16.64,16.64,0,0,0-6.4-1.26,16.94,16.94,0,0,0-4.56.63,12.92,12.92,0,0,0-4,1.88,9.54,9.54,0,0,0-2.85,3.17,9,9,0,0,0-1.08,4.48,8.45,8.45,0,0,0,.84,4,7.74,7.74,0,0,0,2.22,2.65,11.9,11.9,0,0,0,3.21,1.67A39.06,39.06,0,0,0,286.68,28c.7.14,1.5.32,2.41.52a16.11,16.11,0,0,1,2.57.84,6.27,6.27,0,0,1,2.09,1.43,3.15,3.15,0,0,1,.87,2.29,3,3,0,0,1-.59,1.85,4.91,4.91,0,0,1-1.53,1.32,7.36,7.36,0,0,1-2.16.77,12.36,12.36,0,0,1-2.4.24,8.48,8.48,0,0,1-4.6-1.18,19.68,19.68,0,0,1-3.41-2.72l-4.73,3.9a12.89,12.89,0,0,0,5.53,4.59,19.07,19.07,0,0,0,7.21,1.26,21.38,21.38,0,0,0,4.83-.56,12.8,12.8,0,0,0,4.29-1.81,9.89,9.89,0,0,0,3.06-3.24,9.11,9.11,0,0,0,1.18-4.76A9.3,9.3,0,0,0,300.57,28.82Z"></path><path d="M217.84,8.42a17.34,17.34,0,1,0,17.33,17.34A17.34,17.34,0,0,0,217.84,8.42Zm0,28.4a11.07,11.07,0,1,1,11.07-11.06A11.07,11.07,0,0,1,217.84,36.82Z"></path><path d="M156.83,8.42a17.34,17.34,0,1,0,12,29.82l-4-4.86a11,11,0,0,1-18.69-4.91h27.79a17.18,17.18,0,0,0-17.1-20ZM146.14,23a11,11,0,0,1,21.39,0Z"></path><path d="M58.62,8.42A14.58,14.58,0,0,0,44,23V42.25h6.27V23h0a8.32,8.32,0,0,1,8.31-8.31,8.41,8.41,0,0,1,2.52.4V8.65A14,14,0,0,0,58.62,8.42Z"></path><path d="M193.73,8.42A14.57,14.57,0,0,0,179.16,23V42.25h6.26V23h0a8.29,8.29,0,0,1,10.83-7.91V8.65A14,14,0,0,0,193.73,8.42Z"></path></g></g></svg>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Master
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @canany(['lihat-organization'])
                                    <a class="dropdown-item" href="{{ url('organization') }}">
                                        {{ __('Organization') }}
                                    </a>
                                    @endcanany

                                    @canany(['create-user'])
                                    <a class="dropdown-item" href="{{ url('user') }}">
                                        {{ __('User') }}
                                    </a>
                                    @endcanany
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
    </div>
    @include('sweetalert::alert')

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
