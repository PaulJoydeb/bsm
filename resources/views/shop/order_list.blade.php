@extends('master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Order List</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ '/dashboard' }}">Home</a>
                            <span>Order List</span>
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
                                    <th class="shoping__product">Sl No.</th>
                                    <th>Book List</th>
                                    <th>Current Status</th>
                                    <th>Sub Total</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_lists as $key => $order_list)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <?php
                                        $books = json_decode($order_list->json_book_names);
                                        ?>

                                        <td>
                                            @foreach ($books as $book)
                                                <span class="badge badge-secondary">{{ $book->title }} </span>
                                            @endforeach
                                        </td>

                                        <?php
                                       $c_status = '';
                                        if ($order_list->process == 1) {
                                            $status = 'Requested';
                                            if ($order_list->status == 0) {
                                                $c_status = 1;
                                            }
                                        } elseif ($order_list->process == 2) {
                                            $status = 'Processing';
                                            if ($order_list->status == 0) {
                                                $c_status = 1;
                                            }
                                        } elseif ($order_list->process == 3) {
                                            $status = 'Delivered';
                                        }
                                        ?>

                                        <td>{{ $status }} 
                                        <?php   
                                            if ($c_status == 1) {   ?>
                                                <span class="badge badge-danger"> Rejected </span>
                                                <?php }
                                            ?>
                                             </td>
                                        <td>{{ $order_list->subtotal }}</td>
                                        <td>{{ $order_list->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <div>
                            {!! $order_lists->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection
