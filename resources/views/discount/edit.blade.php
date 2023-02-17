@extends('admin_master')
@section('admin_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Discounts/Edit Discount</h1>
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
                        <h6 class="m-0 font-weight-bold text-primary">Edit Discount</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.discount') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $discount->id }}">
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="text" id="form6Example1" class="form-control"
                                            value="{{ $discount->book_aid }}" name="book_aid" readonly/>
                                        <label class="form-label" for="form6Example1" name="surname">Book AID (Authenticate
                                            ID)</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="number" id="form6Example2" class="form-control"
                                            value="{{ $discount->total_discount }}" min="0" name="total_discount" />
                                        <label class="form-label" for="form6Example2 ">Total Discount (%)</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4">Update Discount</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
