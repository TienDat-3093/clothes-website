@extends('layout')


@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admins/</span> Index </h4>

    <div class="mt-2 d-flex align-items-center">
        <a href="{{ route('admin.create') }}" class="btn btn-primary me-2">Add</a>
        <a href="{{ route('admin.pdf') }}" class="btn btn-primary me-5">View PDF</a>

        <form action="{{ route('admin.import-excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group" style="width: 515px">

                <input type="file" name="import_file" class="form-control">
                <br>
                <button type="submit" class="btn btn-primary me-5">Import</button>
            </div>
        </form>
        <form action="{{ route('admin.export-excel') }}" method="GET">
            <div class="input-group" style="width: 515px">
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
    </div>
    <br>
    <div class="input-group input-group-merge">
        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
        <input type="text" id="searchInput" class="form-control" placeholder="Search..." aria-label="Search..."
            aria-describedby="basic-addon-search31">
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
    <script src="{{asset('assets/jquery-3.7.1.min.js')}}"></script>
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
                url: "{{ route('admin.search') }}",
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
