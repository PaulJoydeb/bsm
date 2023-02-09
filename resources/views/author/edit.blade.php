@extends('admin_master')
@section('admin_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Authors/List Author/Update Author</h1>
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
                        <h6 class="m-0 font-weight-bold text-primary">Update Author</h6>
                    </div>
                    <div class="card-body">
                       
                        <form action="{{ route('update.author') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $author->id }}"/>
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="text" id="form6Example1" class="form-control" name="surname" value="{{ $author->surname }}"/>
                                        <label class="form-label" for="form6Example1" name="surname">Surname</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="text" id="form6Example2" class="form-control" name="name" value="{{ $author->name }}"/>
                                        <label class="form-label" for="form6Example2 ">Full name</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Message input -->
                            <div class="form-outline mb-4">
                                <textarea class="form-control" id="form6Example3" rows="4" name="about">{{ $author->about }}</textarea>
                                <label class="form-label" for="form6Example3">Additional information/About</label>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4">Update Author</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
