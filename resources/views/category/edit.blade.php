@extends('admin_master')
@section('admin_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Categories/New Category</h1>
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
                        <h6 class="m-0 font-weight-bold text-primary">Add New Category</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.category') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}"/>
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="text" id="form6Example1" class="form-control" name="name" value="{{ $category->name }}" />
                                        <label class="form-label" for="form6Example1" name="name">Category Name</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <select name="type" id="form6Example2" class="form-control">
                                            <option selected selected> {{ $category->type }} </option>
                                            <option value="bangladesh">BANGLADESH [BD]</option>
                                            <option value="india">INDIA [IN]</option>
                                            <option value="america">AMERICA [USA]</option>
                                            <option value="canada">CANADA [CA]</option>
                                            <option value="japan">JAPAN [JP]</option>
                                        </select>
                                        <label class="form-label" for="form6Example2 ">County Type</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Message input -->
                            <div class="form-outline mb-4">
                                <textarea class="form-control" id="form6Example" rows="4" name="description">{{ $category->description }}</textarea>
                                <label class="form-label" for="form6Example3">Additional Description/About</label>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4">Update Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
