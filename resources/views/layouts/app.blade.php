<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>POS Marhaban 1</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/style.css') }}" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.0.7/dist/boxicons.js' rel='stylesheet'>
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    @livewireStyles
    @stack('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-white shadow">
            <div class="container">
          <div class="row">
            <a class="mr-4" style="text-decoration: none; color:#fff !important;"  href="{{ route('dashboard-penjualan') }}">
                <i class='bx bx-sm bx-fw bx-left-arrow-alt'></i>
            </a>
            <a class="navbar-brand" href="#">
               <small style="margin-top: -2px !important; margin-left: -22px; position: absolute; font-size: 10px;">New</small><b>POS MARHABAN 1</b>
            </a>
          </div>
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
                            {{--  @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif  --}}
                            
                            {{--  @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif  --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  <span>Kasir : <b>{{ Auth::user()->name }}</b></span> 
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
            <div class="container-fluid">
                {{ isset($slot) ? $slot : null  }}
            </div>
        </main>
    </div>

    @livewireScripts
    <script>
        window.addEventListener('closeModal', event => {
            $("#myModal").modal('hide');
        })
        window.addEventListener('openModal', event => {
            $("#myModal").modal('show');
        })
        window.addEventListener('openModalQty', event => {
            $("#ModalQty").modal('show');
        })
        window.addEventListener('closeModalQty', event => {
            $("#ModalQty").modal('hide');
        })
        window.addEventListener('openModalQtyrefil', event => {
            $("#ModalQtyrefil").modal('show');
        })
        window.addEventListener('closeModalQtyrefil', event => {
            $("#ModalQtyrefil").modal('hide');
        })

    </script>
 <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        window.addEventListener('swal',function(e){
            Swal.fire(e.detail);
        });
    </script>
    @stack('js')
</body>
</html>
