@extends('admin_master')
@section('admin_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Books/New Book</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">

            <div class="col-lg-12">

                <!-- Circle Buttons -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add New Book</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('store.book') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="text" id="form6Example1" class="form-control" name="title" />
                                        <label class="form-label" for="form6Example1" name="title">Book Title</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="file" id="form6Example2" class="form-control" name="image" />
                                        <label class="form-label" for="form6Example2 ">Book Image</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <select name="category_id" id="form6Example3" class="form-control">
                                            <option selected>--CHOICE--</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label" for="form6Example3">Choice Category</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <select name="author_id" id="form6Example4" class="form-control">
                                            <option selected>--CHOICE--</option>
                                            @foreach ($authors as $author)
                                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label" for="form6Example4">Choice Author</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="number" id="form6Example5" class="form-control" name="total_books"  min="0" />
                                        <label class="form-label" for="form6Example5">Total Books</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Message input -->
                            <div class="form-outline mb-4">
                                <textarea class="form-control" id="form6Example6" rows="4" name="about"></textarea>
                                <label class="form-label" for="form6Example6">Additional Description
                                    (Optional)</label>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4">Save Book</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
