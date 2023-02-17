@extends('admin_master')
@section('admin_content')
    <style>
        .pagination {
            float: right;
            margin-top: 10px;
        }
    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Discounts/List Discount</h1>
        <p class="mb-4"></p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Discount Table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Book Title</th>
                                <th>Book AID</th>
                                <th>Total Price</th>
                                <th class="text-success">Current Price (After Calculate)</th>
                                <th>Total Discount</th>
                                <th class="text-danger">Discount Price</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($discounts as $key => $discount)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td> {{ $discount->book ? $discount->book->title : "" }} </td>
                                    <td> {{ $discount->book_aid }} </td>
                                    <td> {{ $discount->price ? $discount->price->price : "" }} </td>
                                    <?php 
                                    $total_price = $discount->price ? $discount->price->price : 0;
                                    $discount_percentage = $discount->total_discount ? $discount->total_discount : 0;
                                    $new_price = ($total_price / 100) * $discount_percentage;
                                    $current = $total_price - $new_price;
                                    ?>
                                    <td class="text-success"> {{ $current }} </td>
                                    <td> {{ $discount->total_discount }}% </td>
                                    <td class="text-danger"> {{ $new_price }} </td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{ route('edit.discount', ['id' => $discount->id]) }}">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('delete.discount', ['id' => $discount->id]) }}"
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
                </div>
                {!! $discounts->links() !!}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
