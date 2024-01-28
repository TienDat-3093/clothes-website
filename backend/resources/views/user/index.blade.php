@extends('layout')


@section('content')
    <div class="mt-2 d-flex align-items-center">
        <a href="{{ route('user.pdf') }}" class="btn btn-primary me-5">View PDF</a>
    </div>
    <br>
    <form action="{{ route('user.import-excel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group">

            <input type="file" name="import_file" class="form-control">
            <br>
            <button type="submit" class="btn btn-primary me-5">Import</button>
        </div>
    </form>
    <br>
    <form action="{{ route('user.export-excel') }}" method="GET">
        <div class="input-group">
            <select name="type" class="form-control" required>
                <option value="">Select Excel Format</option>
                <option value="xlsx">XLSX</option>
                <option value="xls">XLS</option>
                <option value="html">HTML</option>
                <option value="csv">CSV</option>
            </select>
            <button type="submit" class="btn btn-primary me-5">Export</button>
        </div>
    </form>
    <br>
    <div class="input-group input-group-merge">
        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
        <input type="text" id="searchInput" class="form-control" placeholder="Search..." aria-label="Search..."
            aria-describedby="basic-addon-search31">
    </div>
    <br>
    <table class="table" id="listUser">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Last Login</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @include('user/results')
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
                url: '{{ route('user.search') }}',
                type: 'POST',
                data: {
                    data: keyword,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $j('#listUser tbody').html(data);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
@endsection
