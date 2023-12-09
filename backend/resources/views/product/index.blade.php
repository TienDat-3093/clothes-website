@extends('layout');

@section('content')

<div class="mt-2 d-flex align-items-center">
    <a href="{{ route('product.create') }}" class="btn btn-primary me-2">Add</a>
    <div class="input-group input-group-merge">
        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
        <input type="text" id="searchInput" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
    </div>
</div>
<br>
<div class="card">


    <h5 class="card-header">List Product</h5>
    <div class="table-responsive text-nowrap">

        <table class="table table-hover" id="listProduct">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>IMAGES</th>
                    <th>DESCRIPTION</th>
                    <th>IMPORT PRICE </th>
                    <th>SALES PRICE</th>
                    <th>STAR AVG</th>
                    <th>ACTIONS</th>

                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @include('product/results')

            </tbody>
        </table>

    </div>
    
</div>


<script src="{{asset('assets/jquery-3.7.1.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#searchInput').on('keyup', function(event) {
            if (event.key === 'Enter') {
                searchProducts();
            }
        });
    });

    function searchProducts() {
        let keyword = $('#searchInput').val();
        $.ajax({
            url: "{{ route('product.search') }}",
            type: 'POST',
            data: {
                data: keyword,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                $('#listProduct tbody').html(data);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
@endsection