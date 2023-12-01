@extends('layout');

@section('content')
<!-- <div class="mt-2">
    <a href="{{route('supplier.create')}}" class="btn btn-primary me-2">Add</a>
    <div class="input-group input-group-merge">
        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
        <input type="text" id="searchInput" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
    </div>
</div> -->
<div class="mt-2 d-flex align-items-center">
    <a href="{{ route('supplier.create') }}" class="btn btn-primary me-2">Add</a>
    <div class="input-group input-group-merge">
        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
        <input type="text" id="searchInput" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
    </div>
</div>
<br>
<div class="card">


    <h5 class="card-header">List Supplier</h5>
    <div class="table-responsive text-nowrap">

        <table class="table table-hover" id="listSupplier">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>PHONE </th>
                    <th>ADDRESS</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>

                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @include('supplier/results')

            </tbody>
        </table>

    </div>
    
</div>


<script src="{{asset('assets/jquery-3.7.1.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#searchInput').on('keyup', function(event) {
            if (event.key === 'Enter') {
                searchSuppliers();
            }
        });
    });

    function searchSuppliers() {
        let keyword = $('#searchInput').val();
        $.ajax({
            url: '{{ route("supplier.search") }}',
            type: 'POST',
            data: {
                data: keyword,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                $('#listSupplier tbody').html(data);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
@endsection