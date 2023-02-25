@extends('master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Favourite</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ '/dashboard' }}">Home</a>
                            <span>Shopping Favourite</span>
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
                                    <th>Discount</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($favourites as $favourite)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img style="height: 100px"
                                                src="storage/{{ $favourite->book ? $favourite->book->image : 'No Image' }}"
                                                alt="">
                                            <h5>{{ $favourite->book ? $favourite->book->title : '' }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">৳
                                            {{ $favourite->price ? $favourite->price->price : 0 }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            {{ $favourite->discount ? $favourite->discount->total_discount : 0 }}%
                                        </td>
                                        <td class="shoping__cart__total">
                                            {{ $favourite->price ? $favourite->price->price : 0 }}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            {{-- <span class="icon_close"></span> --}}
                                            <form action="{{ route('delete.favourite', ['id' => $favourite->id]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <div>
                            {!! $favourites->links() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Favourite</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection
