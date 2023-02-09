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
        <h1 class="h3 mb-2 text-gray-800">Categories/List Category</h1>
        <p class="mb-4"></p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Categories Table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Category Name</th>
                                <th>Category Type</th>
                                <th>Description</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $key => $categorie)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td> {{ $categorie->name }} </td>
                                    <td> {{ $categorie->type }} </td>
                                    <td> {{ $categorie->description }} </td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{ route('edit.category', ['id' => $categorie->id]) }}">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('delete.category', ['id' => $categorie->id]) }}"
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
                {!! $categories->links() !!}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
