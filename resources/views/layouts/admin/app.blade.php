<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Admin | '.'app.name', 'Auction | Admin') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- font awesome style -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('css/responsive.css')  }}" rel="stylesheet" />

</head>
<body>
    <div id="app">
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <a class="navbar-brand"  href="{{ url('/') }}">
                        <span>
                          {{ config('app.name'.' Admin', 'Auction Admin') }}
                        </span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.products') }}"> Products </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.user') }}">Users</a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('bits') }}">Contact Us</a>--}}
{{--                            </li>--}}
                        </ul>
                        <div class="user_option-box">

                            @guest
                                @if (Route::has('login'))
                                    <a
                                        href="{{ route('login') }}"
                                        style="font-size: 14px;"
                                    >
                                        <i class="fa fa-sign-in"></i>
                                        {{ __('Login') }}
                                    </a>
                                @endif
                                @if (Route::has('register'))
                                        <a href="{{ route('register') }}" style="font-size: 14px">
                                            <i class="fa fa-user-plus"></i>
                                            {{ __('Register') }}
                                        </a>
                                @endif
                            @else
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" style="font-size: 14px; font-weight: bold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="navbarDropdown" style="font-size: 14px">
                                    <li>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="font-size: 12px;">
                                            <i class="fa fa-user-circle"></i>
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user-product') }}" style="font-size: 12px;">
                                            <i class="fa fa-product-hunt"></i>
                                            Products
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item nav-link" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="font-size: 12px;">
                                            <i class="fa fa-sign-out"></i>
                                            {{ __('Logout') }}
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            @endguest
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p class="text-center" style=" font-size: 14px; font-weight: bold; text-align: center;">
                                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                </p>

                                <p class="text-center" style=" font-size: 14px; font-weight: bold; text-align: center;">
                                    {{ \Illuminate\Support\Facades\Auth::user()->email }}
                                </p>

                                <p class="text-center" style=" font-size: 14px; font-weight: bold; text-align: center;">
                                    <span style="background: #b2e4ac; border-radius: 45px" class="px-4 py-2 mx-1">{{ \Illuminate\Support\Facades\Auth::user()->type }}</span>
                                    <span style="background: #b2e4ac; border-radius: 45px" class="px-4 py-2 mx-1">{{ \Illuminate\Support\Facades\Auth::user()->status }}</span>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fa fa-close"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>



        </div>
        <main>
            @yield('content')
        </main>
        <!-- footer section -->
        <footer class="footer_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3 footer-col">
                        <div class="footer_detail">
                            <h4>
                                About
                            </h4>
                            <p>
                                Necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with
                            </p>
                            <div class="footer_social">
                                <a href="">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 footer-col">
                        <div class="footer_contact">
                            <h4>
                                Reach at..
                            </h4>
                            <div class="contact_link_box">
                                <a href="">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span>
                  Location
                </span>
                                </a>
                                <a href="">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <span>
                  Call +01 1234567890
                </span>
                                </a>
                                <a href="">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span>
                  demo@gmail.com
                </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 footer-col">
                        <div class="footer_contact">
                            <h4>
                                Subscribe
                            </h4>
                            <form action="#">
                                <input type="text" placeholder="Enter email" />
                                <button type="submit">
                                    Subscribe
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 footer-col">
                        <div class="map_container">
                            <div class="map">
                                <div id="googleMap"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-info">
                    <p>
                        &copy; <span id="displayYear"></span> All Rights Reserved By
                        <a href="https://html.design/">Me</a>
                    </p>
                </div>
            </div>
        </footer>
        <!-- footer section -->

    </div>
</body>
</html>
