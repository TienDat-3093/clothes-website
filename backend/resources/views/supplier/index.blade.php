@extends('layout')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Suppliers/</span> Index </h4>

    <div class="mt-2 d-flex align-items-center">
        <a href="{{ route('supplier.create') }}" class="btn btn-primary me-2">Add</a>
        <a href="{{ route('supplier.pdf') }}" class="btn btn-primary me-5">View PDF</a>

        <form action="{{ route('supplier.import-excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group" style="width: 515px">
                <input type="file" name="import_file" class="form-control">
                <button type="submit" class="btn btn-primary me-5">Import</button>
            </div>
        </form>
        <form action="{{ route('supplier.export-excel') }}" method="GET">
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


    <script src="{{ asset('assets/jquery-3.7.1.min.js') }}"></script>
    <script>
        var $j = jQuery.noConflict();
        $j(document).ready(function() {
            $j('#searchInput').on('keyup', function(event) {
                if (event.key === 'Enter') {
                    searchSuppliers();
                }
            });
        });

        function searchSuppliers() {
            let keyword = $j('#searchInput').val();
            $j.ajax({
                url: '{{ route('supplier.search') }}',
                type: 'POST',
                data: {
                    data: keyword,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $j('#listSupplier tbody').html(data);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
@endsection
