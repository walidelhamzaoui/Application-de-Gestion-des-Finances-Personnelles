<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="/images/icon.png">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/transaction.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>


</head>


<body>

    <!-- Dashboard -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <!-- Vertical Navbar -->
        <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg"
            id="navbarVertical">
            <div class="container-fluid ">
                <!-- Toggler -->
                <button class="navbar-toggler bg-white collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="toggler-icon top-bar"></span>
                    <span class="toggler-icon middle-bar"></span>
                    <span class="toggler-icon bottom-bar"></span>
                </button>
                <!-- Brand -->
                <a class="navbar-brand py-lg-1 mb-lg-0 text-center me-0 mt-3 " href="#">
                    <!-- <h3 class="text-info text-center"><img src="{{asset('images/Artboard 9 copy 5LOGO CPADAI.png')}}"
                            style="width:170px;height:fit-content"></h3> -->
                    <h3 class="fs-4">Management</h3>

                </a>
                <hr>
                <!-- User menu (mobile) -->
                <div class="navbar-user d-lg-none">
                    <!-- Dropdown -->
                    <div class="dropdown">
                        <!-- Toggle -->
                        <!-- <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="avatar-parent-child">
                                <img alt="Image Placeholder" src="{{asset('images/Artboard 9 copy 5LOGO CPADAI.png')}}"
                                    class="avatar avatar- rounded-circle">
                                <span class="avatar-child avatar-badge bg-success"></span>
                            </div>
                        </a> -->

                    </div>
                </div>
                <!-- Collapse -->
                <div class="collapse navbar-collapse " id="sidebarCollapse">
                    <!-- Navigation -->
                    @php
                    use Illuminate\Support\Facades\Route;
                    $dashboard=(Route::is('dashboard'));
                    $transaction=(Route::is('transaction *'));
                    $budget=(Route::is('budget *'));
                    $profile=(Route::is('profile.edit'));
                    $logout=(Route::is('logout'));
                    $defaultClass='
                    nav-link '
                    @endphp
                    <ul class="navbar-nav position-relative  ">

                        <li class="nav-item">
                            <a class="{{ $defaultClass }} {{ $dashboard ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">
                                <i class="bi bi-house" style="font-size:20px"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="{{ $defaultClass }} {{ Request::is('budget') ? 'active' : '' }}"
                                href="{{ route('budget.index') }}">
                                <i class="bi bi-coin" style="font-size:20px"></i> Budget
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="{{ $defaultClass }} {{ Request::is('transaction') ? 'active' : '' }}"
                                href="{{ route('transaction.index') }}">
                                <i class="bi bi-cash-coin" style="font-size:20px"></i> Transaction
                            </a>
                        </li>





                        <li class="nav-item position-lg-fixed bottom-0   col-lg-2 col-6">
                            <a class="{{ $defaultClass }} {{ $logout ? 'active' : '' }}  lougout border-0 pe-lg-5 rounded-2 ms-2 my-2 p-0 m-0 d-lg-flex justify-content-lg-center align-items-center"
                                href="#" onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter?')">
                                <i class="bi bi-box-arrow-left ms-5 " style="font-size:25px;color:black"></i>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class=" btn-link  p-3 text-white">
                                        <h4 class="mb-0">{{ __('Log Out') }}</h4>
                                    </button>
                                </form>
                            </a>
                        </li>



                        <li class="nav-item m-lg-0 mx-5 d-lg-none d-block ">

                            @auth
                            <button
                                class="inline-flex items-center rounded-circle py-2 border border-transparent text-sm leading-4 font-medium text-white-500 hover:text-white-700 focus:outline-none transition ease-in-out duration-150"
                                style="width: 53px; height: 53px; background-color: #6c757d; border: none">
                                <div
                                    style="width: 40px; overflow: hidden; color: white; display: flex; justify-content: center; align-items: center">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    {{ strtoupper(substr(Auth::user()->email, 0, 1)) }}
                                </div>
                            </button>
                            @endauth


                        </li>

                </div>
                </ul>

            </div>
        </nav>
        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <header class="bg-surface-primary border-bottom pt-6  ">
                <div class="container-fluid " style="margin-bottom:7px">
                    <div class="mb-npx ">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0  ">
                                <!-- Title -->
                                <h3 class="fs-4 mb-0 ls-tight mt-1 pb-4 fs-1 text-dark">
                                    Application de Gestion des Finances Personnelles
                                </h3>
                            </div>
                            <!-- Actions -->
                            <div class="col-sm-6 col-12 d-none d-lg-block  text-sm-end">
                                <div class="mx-n1">
                                    @auth
                                    <button
                                        class="inline-flex items-center rounded-circle py-2 border border-transparent text-sm leading-4 font-medium text-white-500 hover:text-white-700 focus:outline-none transition ease-in-out duration-150"
                                        style="width: 53px; height: 53px; background-color: #6c757d; border: none">
                                        <div
                                            style="width: 40px; overflow: hidden; color: white; display: flex; justify-content: center; align-items: center">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                            {{ strtoupper(substr(Auth::user()->email, 0, 1)) }}
                                        </div>
                                    </button>
                                    @endauth



                                    <!-- -->
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </header>
            @yield('user')
            <!-- Header -->

            <!-- Main -->
            @yield('main')

        </div>

    </div>

    <script></script>
</body>

</html>
