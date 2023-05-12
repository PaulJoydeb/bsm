@extends('master')
@section('content')
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Search Results</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ '/dashboard' }}">Home</a>
                            <span>Search Results</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('category.wise', ['id' => $category->id]) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{ $books->count() }}</span> Books found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($books as $book)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg"
                                        data-setbg="{{ asset('storage/' . $book->image . '') }}">
                                        <ul class="product__item__pic__hover">
                                            <li><a href="{{ route('heart', ['id' => $book->id]) }}"><i
                                                        class="fa fa-heart"></i></a></li>
                                            {{-- <li><a href="#"><i class="fa fa-retweet"></i></a></li> --}}
                                            <li><a href="{{ route('cart.store', ['id' => $book->id]) }}"><i
                                                        class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="{{route('product.details', ['id' => $book->id])}}">{{ $book->title }} • {{ $book->author ? $book->author->name : '' }}</a></h6>
                                        <?php
                                        $total_price = $book->price ? $book->price->price : 0;
                                        $discount_percentage = $book->discount ? $book->discount->total_discount : 0;
                                        $new_price = ($total_price / 100) * $discount_percentage;
                                        $current = $total_price - $new_price;
                                        $price = $book->price ? $book->price->price : 0;
                                        ?>
                                        <h5>BDT{!! !empty($discount_percentage) && $discount_percentage > 0
                                            ? '<s class="text-danger">' . $price . '</s> ' . $current
                                            : $price !!}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="">
                        {!! $books->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection
