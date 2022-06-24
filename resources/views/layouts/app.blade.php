<!doctype html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('عادل الشرار', 'عادل الشرار') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    .checked {
        color: orange;
    }
    .nav-item {
        /* padding: 27px; */
        padding-right: 210px;
    }

    .me-auto {
        /* margin-right: auto !important; */
    }

    .navbar-brand {
        margin-right: 15px;
    }

    .form-group {
        margin-bottom: 10px;
         !important
    }

    label {
        font-size: x-large;
    }

    h1 {
        margin-top: 10px;
    }

</style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('users.index') }}">
                    {{ config('عادل الشرار', 'عادل الشرار') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.index') }}">مجاني</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('paidCourses') }}">مدفوع</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">معلومات عنا</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="">معلومات عنا</a>
                            </li>

                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">



                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">تسجيل الدخول</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">انشاء حساب</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->rule_id == 1)
                                        <a class="dropdown-item" href="{{ route('courses.index') }}">
                                            <strong> صفحة الكورسات</strong>
                                        </a>
                                        <a class="dropdown-item" href="{{ route('bookedCourses') }}">
                                            <strong> صفحة الكورسات المحجوزة</strong>
                                        </a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('userBookedCourses') }}">
                                            <strong> الكورسات المحجوزة</strong>
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        تسجيل الخروج
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
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
</body>
<footer>
    <div class="alert alert-secondary" role="alert" style="margin-top: 10px;">
        <p class="text-center">جميع الحقوق محفوظة لعادل الشرار</p>
    </div>
</footer>

</html>
