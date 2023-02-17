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
        <h1 class="h3 mb-2 text-gray-800">Books/List Book</h1>
        <p class="mb-4"></p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Books Table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Book ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Total Books</th>
                                <th>Books Price (Individual)</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($books as $key => $book)
                                <tr>
                                    <td>BMS-{{ $book->id}}</td>
                                    <td> {{ $book->title }} </td>
                                    <td> <img style="height: 50px; weight:50px;" src="{{ asset('storage/'.$book->image) }}" alt=""> </td>
                                    <td> {{ $book->cateogry ? $book->cateogry->name : ''}} </td>
                                    <td> {{ $book->author ? $book->author->name : ''}} </td>
                                    <td> {{ $book->total_books }} </td>
                                    <td> {{ $book->price->price }} </td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{ route('edit.book', ['id' => $book->id]) }}">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('delete.book', ['id' => $book->id]) }}"
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
                {!! $books->links() !!}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
