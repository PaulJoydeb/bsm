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
        <h1 class="h3 mb-2 text-gray-800">Pending/List Pending</h1>
        <p class="mb-4"></p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pending Table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Book List (Title)</th>
                                <th>Sub Total</th>
                                <th>Total Price</th>
                                <th>User Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($buy_books as $key => $buy_book)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <?php
                                    $books = json_decode($buy_book->json_book_names);
                                    ?>
                                    <td>
                                        @foreach ($books as $book)
                                            <span class="badge badge-secondary">{{ $book->title }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $buy_book->subtotal }}</td>
                                    <td>{{ $buy_book->total }}</td>
                                    <td>{{ $buy_book->user ? $buy_book->user->name : ''}}</td>
                                    <td>
                                        <a class="btn btn-success "
                                            href="{{ route('accept.pending', ['id' => $buy_book->id]) }}">Accept</a>
                                        <a class="btn btn-danger"
                                            href="{{ route('reject.pending', ['id' => $buy_book->id]) }}">Reject</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $buy_books->links() !!}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
