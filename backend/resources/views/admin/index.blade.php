@extends('layout')


@section('content')
    <div class="mt-2 d-flex align-items-center">
        <a href="{{ route('admin.create') }}" class="btn btn-primary me-5">Add</a>
        <div class="input-group input-group-merge">
            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Search..." aria-label="Search..."
                aria-describedby="basic-addon-search31">
        </div>
    </div>
    <br>
    <table class="table" id="listAdmin">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Last Login</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @include('admin/results')
        </tbody>
    </table>
    <script src="{{ asset('assets/jquery-3.7.1.min.js') }}"></script>
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
                url: "{{route('admin.search')}}",
                type: 'POST',
                data: {
                    data: keyword,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#listAdmin tbody').html(data);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
@endsection
