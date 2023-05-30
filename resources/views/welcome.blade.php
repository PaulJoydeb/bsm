<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BMS | Book Management Service</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/management.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>BDT {{ total() }}</span></div>
        </div>
        <div class="humberger__menu__widget">
            @if (Route::has('login'))
                @auth
                @else
                    <div class="header__top__right__auth">
                        <a href="{{ route('login') }}"><i class="fa fa-user"></i> Log in</a>
                    </div>

                    @if (Route::has('register'))
                        <div class="header__top__right__auth_reg">
                            <a href="{{ route('register') }}"><i class="fa fa-user"></i> Register</a>
                        </div>
                    @endif
                @endauth
            @endif
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('shop-grid') }}">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.html">Your Order</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> bms@gmail.com</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
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
                            @if (Route::has('login'))
                                @auth
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
                                @else
                                    <div class="header__top__right__auth">
                                        <a href="{{ route('login') }}"><i class="fa fa-user"></i> Log in</a>
                                    </div>

                                    @if (Route::has('register'))
                                        <div class="header__top__right__auth_reg">
                                            <a href="{{ route('register') }}"><i class="fa fa-user"></i> Register</a>
                                        </div>
                                    @endif
                                @endauth
                            @endif

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
                        <a href="{{ url('/') }}" class="home_name">BOOK MS.</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ route('shop-grid') }}">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="{{ route('show.cart') }}">Shoping Cart</a></li>
                                    <li><a href="{{ route('checkout') }}">Check Out</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('ordered') }}">Your Order</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="{{ route('show.favourite') }}"><i class="fa fa-heart"></i>
                                    <span>{{ totalFavourite() }}</span></a></li>
                            <li><a href="{{ route('show.cart') }}"><i class="fa fa-shopping-bag"></i>
                                    <span>{{ totalCart() }}</span></a></li>
                        </ul>
                        <div class="header__cart__price">item: <span>BDT {{ total() }}</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All Categories</span>
                        </div>
                        <ul>
                            @foreach ($categories as $categorie)
                                <li><a
                                        href="{{ route('category.wise', ['id' => $categorie->id]) }}">{{ $categorie->name }}</a>
                                </li>
                            @endforeach
                            {{-- <li><a href="#">School</a></li>
                            <li><a href="#">College</a></li>
                            <li><a href="#">University</a></li>
                            <li><a href="#">Medical</a></li>
                            <li><a href="#">Engineering</a></li>
                            <li><a href="#">Nursing</a></li>
                            <li><a href="#">Acounting</a></li>
                            <li><a href="#">Programming</a></li>
                            <li><a href="#">Historical</a></li>
                            <li><a href="#">Poets</a></li>
                            <li><a href="#">Adventure stories</a></li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            {{-- <form action="#">
                                <select name="categories" id="categories" class="border-0 rounded-0">
                                    <option value="" selected>All Categories</option>
                                    @foreach ($categories as $categorie)
                                        <option value="">{{ $categorie->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" placeholder="What do you need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form> --}}
                            <form action="{{ route('search') }}" method="POST">
                                @csrf
                                {{-- <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div> --}}
                                <input type="text" name="search" placeholder="Type Book/Author Name...">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+880 0000000000</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="img/hero/banner.png">
                        <div class="hero__text">
                            <span>BOOKS</span>
                            <h2>So many books,<br />so little time.</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="{{ route('shop-grid') }}" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    {{-- <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('img/categories/school.png') }}">
                            <h5><a type="button" class="btn btn-outline-success btn-sm rounded-0"
                                    href="#">School</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/college.png">
                            <h5><a type="button" class="btn btn-outline-success btn-sm rounded-0"
                                    href="#">College</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/university.png">
                            <h5><a type="button" class="btn btn-outline-success btn-sm rounded-0"
                                    href="#">University</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/medical.png">
                            <h5><a type="button" class="btn btn-outline-success btn-sm rounded-0"
                                    href="#">Medical</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/engineering.png">
                            <h5><a type="button" class="btn btn-outline-success btn-sm rounded-0"
                                    href="#">Engneering</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/nursing.png">
                            <h5><a type="button" class="btn btn-outline-success  rounded-0"
                                    href="#">Nursing</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Books</h2>
                    </div>
                    {{-- <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".oranges">Pre-Order</li>
                            <li data-filter=".fresh-meat">New Release</li>
                            <li data-filter=".vegetables">Admission Carnival</li>
                            <li data-filter=".fastfood">Novel</li>
                        </ul>
                    </div> --}}
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($books as $book)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="storage/{{ $book->image }}">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="{{ route('heart', ['id' => $book->id]) }}"><i
                                                class="fa fa-heart"></i></a></li>
                                    {{-- <li><a href="#"><i class="fa fa-retweet"></i></a></li> --}}
                                    <li><a href="{{ route('cart.store', ['id' => $book->id]) }}"><i
                                                class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a
                                        href="{{ route('product.details', ['id' => $book->id]) }}">{{ $book->title }} • {{ $book->author ? $book->author->name : '' }}</a>
                                </h6>
                                <?php
                                $total_price = $book->price ? $book->price->price : 0;
                                $discount_percentage = $book->discount ? $book->discount->total_discount : 0;
                                $new_price = ($total_price / 100) * $discount_percentage;
                                $current = $total_price - $new_price;
                                $price = $book->price ? $book->price->price : 0;
                                ?>
                                <h5>{!! !empty($discount_percentage) && $discount_percentage > 0
                                    ? '<s class="text-danger">' . $price . '</s> ' . $current
                                    : $price !!}BDT</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    {{-- <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Banner End -->
    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            {{-- <a href="./index.html"><img src="img/logo.png" alt=""></a> --}}
                            <a href="{{ url('/') }}" class="home_name">BOOK MS.</a>
                        </div>
                        <ul>
                            <li>Address: Paltan VIP Road, Dhaka</li>
                            <li>Phone: +880 000000000</li>
                            <li>Email: bms@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li><a href="{{ route('shop-grid') }}">Shop</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                        <ul>
                            <li><a href="{{ route('show.favourite') }}">Favourite</a></li>
                            <li><a href="{{ route('show.cart') }}">Cart</a></li>
                            <li><a href="{{ route('ordered') }}">Your Order</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="{{ route('newsletter') }}" method="POST">
                            @csrf
                            <input type="email" name="email" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                        <div class="footer__copyright__payment row">
                            <img style="height: 18px; weight: 18px;" src="{{ asset('img/payment-item.png') }}"
                                alt="">
                            <h6 class="font-weight-bold">ONLY CASH ON DELIVERY</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('js/mixitup.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        $(window).scroll(function() {
            if ($(this).scrollTop() > 0) {
                $('.nice-select').hide();
                // $('.nice-select').fadeOut();
            } else {
                $('.nice-select').show();
                // $('.nice-select').fadeIn();
            }
        });
    </script>




</body>

</html>
