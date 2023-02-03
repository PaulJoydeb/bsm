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
        <h1 class="h3 mb-2 text-gray-800">Authors/List Author</h1>
        <p class="mb-4"></p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Authors Table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Surname</th>
                                <th>Full Name</th>
                                <th>About</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($authors as $key => $author)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td> {{ $author->surname }} </td>
                                    <td> {{ $author->name }} </td>
                                    <td> {{ $author->about }} </td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{ route('edit.author', ['id' => $author->id]) }}">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('delete.author', ['id' => $author->id]) }}"
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
                {!! $authors->links() !!}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
