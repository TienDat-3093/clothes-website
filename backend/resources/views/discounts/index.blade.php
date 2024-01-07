@extends('layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Discounts /</span> Index </h4>

        <div class="mt-2 d-flex align-items-center">
            <a href="{{ route('discounts.create') }}" class="btn btn-primary me-5">Add</a>
            <div class="input-group input-group-merge">
                <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                <input type="text" id="searchInput" class="form-control" placeholder="Search..." aria-label="Search..."
                    aria-describedby="basic-addon-search31">
            </div>
        </div>
        <br>

        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table" id="listDiscounts">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Amount Discounts</th>
                            <th>Type Discounts</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @include('discounts/search')
                    </tbody>
                </table>
            </div>
        </div>

        <script src="{{ asset('assets/jquery-3.7.1.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('#searchInput').on('keyup', function(event) {
                    if (event.key === 'Enter') {
                        searchDiscounts();
                    }
                });
            });

            function searchDiscounts() {
                let keyword = $('#searchInput').val();
                $.ajax({
                    url: '{{ route('discounts.search') }}',
                    type: 'POST',
                    data: {
                        data: keyword,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        $('#listDiscounts tbody').html(data);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
        </script>
        <hr class="my-5" />
    </div>
@endsection
