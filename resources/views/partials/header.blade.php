<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> bms@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">

                        <div class="header__top__right__user">
                            <i class="fa fa-user"></i>
                            <div>{{ Auth::user()->name }}</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                                <li>
                                    {{-- <a href="{{ route('logout') }}">{{ __('Log Out') }}</a> --}}
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('alert')
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    {{-- <a href="{{ url('/') }}"><img src="{{asset('img/logo.png')}}" alt=""></a> --}}
                    <a href="{{ url('/dashboard') }}" class="home_name">BOOK MS.</a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a
                                href="{{ '/dashboard' }}">Home</a></li>
                        <li class="{{ Route::is('shop-grid') ? 'active' : '' }}"><a
                                href="{{ route('shop-grid') }}">Shop</a></li>
                        <li class="{{ Route::is('show.cart') || Route::is('checkout') ? 'active' : '' }}"><a
                                href="#">Pages</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="{{ route('show.cart') }}">Shoping Cart</a></li>
                                <li><a href="{{ route('checkout') }}">Check Out</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('ordered')}}">Your Order</a></li>
                        <li class="{{ Route::is('contact') ? 'active' : '' }}"><a
                                href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="{{ route('show.favourite') }}"><i class="fa fa-heart"></i> <span>{{ totalFavourite() }}</span></a></li>
                        <li><a href="{{ route('show.cart') }}"><i class="fa fa-shopping-bag"></i> <span>{{ totalCart() }}</span></a>
                        </li>
                    </ul>
                    <div class="header__cart__price">item: <span>BDT {{total()}}</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
