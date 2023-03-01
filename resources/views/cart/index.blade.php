@extends('master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ '/dashboard' }}">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img style="height: 100px"
                                                src="storage/{{ $cart->book ? $cart->book->image : 'No Image' }}"
                                                alt="">
                                            <h5>{{ $cart->book ? $cart->book->title : '' }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">BDT
                                            {{ $cart->price ? $cart->price->price : 0 }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="{{ $cart->quantity }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">BDT
                                            {{ $cart->price ? $cart->price->price : 0 }}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            {{-- <span class="icon_close"></span> --}}
                                            <form action="{{ route('delete.cart', ['id' => $cart->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger rounded-0"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <form action="{{ route('process.checkout') }}" method="POST">
                            @csrf
                            <h5>Cart Total</h5>
                            <ul>
                                <li>Subtotal <span>BDT {{ $subtotal_price }}</span></li>
                                <li>Discount <span>BDT {{ $subtotal_price - $total_price }}</span></li>
                                <li>Total <span>BDT {{ $total_price }}</span></li>
                            </ul>
                            <button type="submit" class="primary-btn border-0">PROCEED TO CHECKOUT</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection
