{{--<div class="color-switcher-toggle animated pulse infinite">--}}
{{--<i class="material-icons">settings</i>--}}
{{--</div>--}}
<div class="container-fluid">
    <div class="row">
        <!-- Main Sidebar -->
    @include('admin.layouts.parts.sidebar')
    <!-- End Main Sidebar -->
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
            <div class="main-navbar sticky-top bg-white">
                <!-- Main Navbar -->
                <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
                    <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                        {{--                        <div class="input-group input-group-seamless ml-3">--}}
                        {{--                            <div class="input-group-prepend">--}}
                        {{--                                <div class="input-group-text">--}}
                        {{--                                    <i class="fas fa-search"></i>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>--}}
                    </form>
                    <ul class="navbar-nav border-left flex-row ">
                        {{--<li class="nav-item border-right dropdown notifications">--}}
                        {{--<a class="nav-link nav-link-icon text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                        {{--<div class="nav-link-icon__wrapper">--}}
                        {{--<i class="material-icons">&#xE7F4;</i>--}}
                        {{--<span class="badge badge-pill badge-danger">2</span>--}}
                        {{--</div>--}}
                        {{--</a>--}}
                        {{--<div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">--}}
                        {{--<a class="dropdown-item" href="#">--}}
                        {{--<div class="notification__icon-wrapper">--}}
                        {{--<div class="notification__icon">--}}
                        {{--<i class="material-icons">&#xE6E1;</i>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="notification__content">--}}
                        {{--<span class="notification__category">Тест</span>--}}
                        {{--<p>Что то произошло--}}
                        {{--<span class="text-success text-semibold">28%</span>красавчик</p>--}}
                        {{--</div>--}}
                        {{--</a>--}}
                        {{--                                <a class="dropdown-item" href="#">--}}
                        {{--                                    <div class="notification__icon-wrapper">--}}
                        {{--                                        <div class="notification__icon">--}}
                        {{--                                            <i class="material-icons">&#xE8D1;</i>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="notification__content">--}}
                        {{--                                        <span class="notification__category">Sales</span>--}}
                        {{--                                        <p>Last week your store’s sales count decreased by--}}
                        {{--                                            <span class="text-danger text-semibold">5.52%</span>. It could have been worse!</p>--}}
                        {{--                                    </div>--}}
                        {{--                                </a>--}}
                        {{--<a class="dropdown-item notification__all text-center" href="#"> Все нотификаций </a>--}}
                        {{--</div>--}}
                        {{--</li>--}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#"
                               role="button" aria-haspopup="true" aria-expanded="false">
                                @if(Auth::user() && Auth::user()->image_path)
                                    <img class="user-avatar rounded-circle mr-2" src="{{asset(Auth::user()->image_path)}}">
                                @else
                                    <span class="user-avatar rounded-circle mr-2 material-icons">
                                    tag_faces
                                    </span>
                                @endif
                                <span class="d-none d-md-inline-block">Админ тест</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-small">
                                <a class="dropdown-item" href="{{route('users.profile')}}">
                                <i class="material-icons">&#xE7FD;</i> Профиль</a>

                                <form action="{{route('logout')}}" method="post">
                                    {{csrf_field()}}
                                    <button type="submit" class="dropdown-item text-danger" href="{{route('logout')}}">
                                        <i class="material-icons text-danger">&#xE879;</i> Выйти
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                    <nav class="nav">
                        <a href="#"
                           class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
                           data-toggle="collapse" data-target=".header-navbar" aria-expanded="false"
                           aria-controls="header-navbar">
                            <i class="material-icons">&#xE5D2;</i>
                        </a>
                    </nav>
                </nav>
            </div>
            <div class="main-content-container container-fluid px-4">
                <!-- / .main-navbar -->
