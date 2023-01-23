<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Manage Income</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style-switcher.css') }}" rel="stylesheet">
        <link href="{{ asset('css/aos.css') }}" rel="stylesheet">
    </head>
    <body class="">
        
        <!-- preloader start -->
        <div class="preloader js-preloader">
            <div></div>
        </div>
        <!-- preloader end -->

            <div class="container">
                <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg js-header header">
                    <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="col-5 py-3">
                        <div class="logo" data-aos="fade-down" data-aos-duration="1000">
                        <!-- <div class="logo"> -->
                            <a href="{{ route('home') }}">Mange Income <span> Cash is king</span></a>
                        </div>
                    </div>
                    
                    <div class="col-7  d-flex justify-content-end">
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-center nav1" data-aos="fade-down" data-aos-duration="1000">
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                            @endguest
                            @auth
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('home') }}">Save Income</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('wish') }}">Wish List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('income') }}">Mange Income</a>
                            </li>
                          
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <input type="submit" class="nav-link logout" value='Logout'>
                                </form>
                            </li>
                            @endauth
                        </ul>
                        
                    </div>
                    </div>
                    
                    </div>
                    </nav> 
                </div>
                    </div>
            </div>
          
            <main class="py-4">
            @yield('content')
            </main>
            <!-- style switcher start -->
            <div class="style-switcher js-style-switcher">
                <button type="button" class="style-switcher-toggler js-style-switcher-toggler">
                    <i class="fas fa-cog"></i>
                </button>
                <div class="style-switcher-main">
                    <h2>style switcher</h2>
                    <div class="style-switcher-item">
                        
                            <p>Theme Color</p>
                        <div class="theme-color">
                            <input type="range" min="0" max="360" class="hue-slider js-hue-slider">
                            <div class="hue"><span class="js-hue">Hue</span></div>
                        </div>  
                    </div>
                    <div class="style-switcher-item">
                        <label class="form-switch">
                                <span>Dark Mode</span>
                                <input type="checkbox" class="js-dark-mode">
                                <div class="box"></div>    
                        </label>
                    </div>
                </div>
            </div>
            <!-- style switcher end -->
            <script src="{{ asset('js/app.js') }}" defer></script>
            <script src="{{ asset('js/main.js') }}" defer></script>
            <script src="{{ asset('js/style-switcher.js') }}" defer></script>
            <script src="{{ asset('js/aos.js') }}" defer></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    </body>
</html>
