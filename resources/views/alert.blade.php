@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        @endforeach
    </ul>
</div>
@endif

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
    <ul>
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
    </ul>
</div>
@endif