@extends('layout')


@section('content')
    <div class="mt-2 d-flex align-items-center">
        <a href="{{ route('cart.pdf') }}" class="btn btn-primary me-5">View PDF</a>

    </div>

    <br>
    <div class="input-group input-group-merge">
        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
        <input type="text" id="searchInput" class="form-control" placeholder="Search..." aria-label="Search..."
            aria-describedby="basic-addon-search31">
    </div>
    <br>
    <table class="table" id="listCart">
        <thead>
            <tr>
                <th>Id</th>
                <th>Total Price</th>
                <th>User</th>
                <th>Discount</th>
                <th>Status Cart</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @include('cart/results')
        </tbody>
    </table>
    <script src="{{ asset('assets/jquery-3.7.1.min.js') }}"></script>
    <script>
        var $j = jQuery.noConflict();
        $j(document).ready(function() {
            $j('#searchInput').on('keyup', function(event) {
                if (event.key === 'Enter') {
                    search();
                }
            });
        });

        function search() {
            let keyword = $j('#searchInput').val();
            $j.ajax({
                url: '{{ route('cart.search') }}',
                type: 'POST',
                data: {
                    data: keyword,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $j('#listCart tbody').html(data);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
@endsection
