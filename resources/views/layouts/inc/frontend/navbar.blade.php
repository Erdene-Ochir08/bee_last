<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<div class="a-overlay"></div>
<section class="top">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="flex">
                    <div class="info">
                        <i class="bi bi-telephone-fill"></i> {{$client->phone_number}}
                    </div>
                    <div class="info">
                        <i class="bi bi-envelope-fill"></i> {{$client->email}}
                    </div>
                    <div class="info">
                        <i class="bi bi-geo-alt-fill"></i> {{$client->shop_address}}
                    </div>
                    <div class="info">
                        <i class="bi bi-clock-fill"></i> {{$client->working_hour}}
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="flex icon">
                    <a class="info" href="{{$client->facebook_link}}">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a class="info" href="{{$client->instagram_link}}" >
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a class="info" href="{{$client->youtube_link}}">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a class="info" href="{{$client->twitter_link}}">
                        <i class="bi bi-twitter"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- sticky-top -->
<div class="main-navbar shadow-sm sticky-top">
    <div class="top-navbar">
        <div class="container">
            <div class="row">
                <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                    <a href="{{url('/')}}">
                        <img src="{{ asset("$client->shop_logo") }}" alt="" width="100%">
                    </a>
                </div>
                <div class="col-md-5 my-auto menu">
                    <ul>
                        <li><a href="{{ url('/') }}" class="active">Нүүр</a></li>
                        <li><a href="{{ url('/collections') }}">Ангилал</a></li>
                        <li><a href="{{ url('/new') }}">Шинэ</a></li>
                        <li><a href="{{ url('/trend') }}">Онцлох</a></li>
                        <li><a href="{{ url('/sale') }}">Хямдрал</a></li>
                        <li><a href="#footer">Холбоо барих</a></li>
                    </ul>
                </div>
                <div class="col-md-2 my-auto">
                    <form role="search" action="{{url('search')}}" method="GET">
                        <div class="input-group">
                            <input type="search" name="search" value="{{Request::get('search')}}" placeholder="Хайх..." class="form-control" />
                            <button class="btn bg-white" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-3 my-auto desk">
                    <ul class="nav justify-content-end">
                        <!--  -->
                        <li class="nav-item">
                            <a class="nav-link open">
                                <i class="fa fa-shopping-cart"></i> (<livewire:frontend.cart.cart-count/>)
                            </a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"> Login</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                     {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        @if(Auth::user()->role_as == 1)
                                        <a class="dropdown-item" href="{{ url('admin/dashboard') }}">
                                            <i class="fa fa-home"></i>admin dashboard
                                        </a>
                                        @endif
                                        <a class="dropdown-item" href="{{ url('orders') }}">
                                            <i class="fa fa-tasks"></i> Захиалгууд
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                        </a>
                                        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
    <!-- <nav class="navbar navbar-expand-lg desk">
        <div class="container">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item cat">
                        <a href="" class="nav-link"> Бүх ангилал <i class="bi bi-chevron-down"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"  href="{{ url('/') }}">Нүүр</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/collections') }}">Бүх категори</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/sale') }}">Хямдралтай бүтээгдэхүүн</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/new') }}">Шинэ бүтээгдэхүүн</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/trend') }}">Онцлох бүтээгдэхүүн</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#footer">Холбоо барих</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->
</div>
<div class="mobile-header">
   <nav class="navbar navbar-expand-lg">
        <div class="container">
            <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <!-- class="nav-link" href="{{ url('cart') }}" -->
                            <a class="nav-link open2">
                                <i class="fa fa-shopping-cart"></i> Миний сагс (<livewire:frontend.cart.cart-count/>)
                            </a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        @if(Auth::user()->role_as == 1)
                                        <a class="dropdown-item" href="{{ url('admin/dashboard') }}">
                                            <i class="fa fa-home"></i>admin dashboard
                                        </a>
                                        @endif
                                        <a class="dropdown-item" href="{{ url('orders') }}">
                                            <i class="fa fa-tasks"></i> Захиалгууд
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item cat">
                        <a href="" class="nav-link"> Бүх ангилал <i class="bi bi-chevron-down"></i></a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link active"  href="{{ url('/') }}">Нүүр</a>
                    </li>

{{--                    <li class="nav-item dropdown">--}}
{{--                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                            Category Dropdown--}}
{{--                        </a>--}}
{{--                        <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">--}}
{{--                            @foreach ($categories as $category)--}}
{{--                                <li><a class="dropdown-item" href="{{ url('/collections', ['category' => $category->name]) }}">{{ $category->name }}</a></li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </li>--}}

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/collections') }}">Бүх категори</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/sale') }}">Хямдралтай бүтээгдэхүүн</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/new') }}">Шинэ бүтээгдэхүүн</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/trend') }}">Онцлох бүтээгдэхүүн</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#footer">Холбоо барих</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="card-menu">
    <div class="c-title">
        <h3>Миний сагс</h3>
        <div class="close"><i class="fa fa-times" aria-hidden="true"></i></div>
    </div>
    <div class="c-info">

    </div>
</div>