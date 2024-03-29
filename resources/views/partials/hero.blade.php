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
                        <li><a href="#">School</a></li>
                        <li><a href="#">College</a></li>
                        <li><a href="#">University</a></li>
                        <li><a href="#">Medical</a></li>
                        <li><a href="#">Engineering</a></li>
                        <li><a href="#">Nursing</a></li>
                        <li><a href="#">Acounting</a></li>
                        <li><a href="#">Programming</a></li>
                        <li><a href="#">Historical</a></li>
                        <li><a href="#">Poets</a></li>
                        <li><a href="#">Adventure stories</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            {{-- <div class="hero__search__categories"> --}}
                            {{-- All Categories
                                <span class="arrow_carrot-down"></span> --}}
                            <select name="categories" id="categories" class="border-0 rounded-0">
                                <option value="" selected>All Categories</option>
                                @foreach ($categories as $categorie)
                                    <option value="">{{ $categorie->name }}</option>
                                @endforeach
                            </select>
                            {{-- </div> --}}
                            <input type="text" placeholder="What do you need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+8801900000000 </h5>
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
