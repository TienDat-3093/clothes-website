@extends('layout')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Categories /</span> Index </h4>

    <div class="mt-2 d-flex align-items-center">
        <a href="{{ route('categories.create') }}" class="btn btn-primary me-2">Add</a>
        <a href="{{ route('categories.pdf') }}" class="btn btn-primary me-5">View PDF</a>

        <form action="{{ route('categories.import-excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group" style="width: 515px">

                <input type="file" name="import_file" class="form-control">
                <br>
                <button type="submit" class="btn btn-primary me-5">Import</button>
            </div>
        </form>
        <form action="{{ route('categories.export-excel') }}" method="GET">
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

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table" id="listCategories">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Product Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @include('categories.search')
                </tbody>
            </table>
        </div>
    </div>

    <script src="{{ asset('assets/jquery-3.7.1.min.js') }}"></script>
    <script>
        var $j = jQuery.noConflict();
        $j(document).ready(function() {
            $j('#searchInput').on('keyup', function(event) {
                if (event.key === 'Enter') {
                    searchCategories();
                }
            });
        });

        function searchCategories() {
            let keyword = $j('#searchInput').val();
            $j.ajax({
                url: "{{ route('categories.search') }}",
                type: 'POST',
                data: {
                    data: keyword,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $j('#listCategories tbody').html(data);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
    <hr class="my-5" />
@endsection
