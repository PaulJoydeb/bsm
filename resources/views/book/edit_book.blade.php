@extends('admin_master')
@section('admin_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Books/Edit Book</h1>
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
                        <h6 class="m-0 font-weight-bold text-primary">Edit Book</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.book') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $book->id }}">
                            <input type="hidden" name="price_id" value="{{ $book->price ? $book->price->id : 0 }}">
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="text" id="form6Example1" class="form-control" value="{{ $book->title }}"
                                            name="title" />
                                        <label class="form-label" for="form6Example1" name="title">Book Title</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="file" id="form6Example2" class="form-control" name="image" />
                                        <label class="form-label" for="form6Example2 ">Previous Image:</label>
                                        <img style="height: 50px; weight:50px;" src="{{ asset('storage/'.$book->image) }}" alt="">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="number" id="form6Example7" class="form-control" value="{{ $book->price->price }}" name="price" min="0"/>
                                        <label class="form-label" for="form6Example7" name="title">Book Price (৳)</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <select name="category_id" id="form6Example3" class="form-control">
                                            <option value="{{$book->cateogry ? $book->cateogry->id : " "}}" selected>{{ $book->cateogry ? $book->cateogry->name : " " }}</option>
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
                                            <option value="{{ $book->author ? $book->author->id : " "}}" selected>{{ $book->author ? $book->author->name : " "}}</option>
                                            @foreach ($authors as $author)
                                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label" for="form6Example4">Choice Author</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="number" id="form6Example5" class="form-control" value="{{ $book->total_books }}" name="total_books"
                                            min="0" />
                                        <label class="form-label" for="form6Example5">Total Books</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Message input -->
                            <div class="form-outline mb-4">
                                <textarea class="form-control" id="form6Example6" rows="4" name="description">{{ $book->description }}</textarea>
                                <label class="form-label" for="form6Example6">Additional Description
                                    (Optional)</label>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4">Update Book</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
