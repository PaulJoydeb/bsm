<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        {{-- <a href="./index.html"><img src="img/logo.png" alt=""></a> --}}
                        <a href="{{ url('/dashboard') }}" class="home_name">BOOK MS.</a>
                    </div>
                    <ul>
                        <li>Address: Paltan VIP Road, Dhaka</li>
                        <li>Phone: +8801900000000 </li>
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
