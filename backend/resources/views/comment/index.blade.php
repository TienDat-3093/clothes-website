@extends('layout')


@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Comments/</span> Index </h4>

    <div class="mt-2 d-flex align-items-center">
        <a href="{{ route('comment.pdf') }}" class="btn btn-primary me-5">View PDF</a>

        <form action="{{ route('comment.export-excel') }}" method="GET">
            <div class="input-group" style="width: 1100px">
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
    <table class="table" id="listComment">
        <thead>
            <tr>
                <th>Id</th>
                <th>Content</th>
                <th>Ratings</th>
                <th>User</th>
                <th>Product</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @include('comment/results')
        </tbody>
    </table>
    <script src="{{asset('assets/jquery-3.7.1.min.js')}}"></script>
    <script>
        var $j = jQuery.noConflict();
        $j(document).ready(function() {
            $j('#searchInput').on('keyup', function(event) {
                if (event.key === 'Enter') {
                    searchComments();
                }
            });
        });

        function searchComments() {
            let keyword = $j('#searchInput').val();
            $j.ajax({
                url: "{{ route('comment.search') }}",
                type: 'POST',
                data: {
                    data: keyword,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $j('#listComment tbody').html(data);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
@endsection
