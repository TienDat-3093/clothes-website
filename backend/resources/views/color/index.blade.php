@extends('layout')

@section('content')
    @include('color.modals')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Colors /</span> Index </h4>

    <div class="mt-2 d-flex align-items-center">
        <button class="btn btn-primary me-2" data-toggle="modal" data-target="#addColor">Add</button>
        <a href="{{ route('color.pdf') }}" class="btn btn-primary me-5">View PDF</a>

        <form action="{{ route('color.import-excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group" style="width: 515px">

                <input type="file" name="import_file" class="form-control">
                <br>
                <button type="submit" class="btn btn-primary me-5">Import</button>
            </div>
        </form>
        <form action="{{ route('color.export-excel') }}" method="GET">
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
    <div class="card">
        <h5 class="card-header">Colors</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover" id="listColor">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @include('color/results')
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ asset('assets/jquery-3.7.1.min.js') }}"></script>
    <script>
        var $j = jQuery.noConflict();
        var currentColorID;
        $j(document).ready(function() {
            $j(document).on('click', '.edit-button', function() {
                console.log("tt")
                var colorID = $j(this).data('color-id');

                console.log('color', colorID);
                currentColorID = null;
                console.log('curen_1', currentColorID)
                currentColorID = colorID;
                console.log('curen_2', currentColorID)
                updateColor(currentColorID);
            });

            $j(document).on('click', '#btnCreateColor', function() {
                createColor();
                $("#createForm")[0].reset();

            });
            $j(document).on('click', '#btnUpdateColor', function() {
                updateColorHandle(currentColorID);
            });
        });
        $j(document).ready(function() {})
        var csrfToken = '{{ csrf_token() }}';

        function createColor() {
            var formElement = $('form#createForm')[0];
            var formData = new FormData(formElement);

            formData.append('_token', csrfToken);
            $j.ajax({
                url: "{{ route('color.create') }}",
                type: "POST",
                data: formData,
                contentType: false, // sẽ trả về string or json Không đặt ContentType để FormData tự động xử lý data
                processData: false, // Không xử lý dữ liệu trước khi gửi
                success: function(data) {
                    $j('#listColor tbody').html(data);
                    /* Swal.fire({
                        title: 'Xác Nhận Xóa?',
                        text: 'Bạn có chắc muốn xóa ',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Đồng ý',
                        cancelButtonText: 'Hủy bỏ',
                    }) */
                },
                error: function() {
                    console.error('Có lỗi xảy ra khi gửi dữ liệu.');
                }
            })
        }

        function updateColor(colorID) {
            $j.ajax({
                url: '/color/update/' + colorID,
                type: "GET",
                success: function(data) {

                    $j("#updateColor #name").val(data.data.name);
                    $j("#updateColor").modal("hide");
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            })
        }

        function updateColorHandle(colorID) {
            var formElement = $('form#updateForm')[0];
            var formData = new FormData(formElement);

            formData.append('_token', csrfToken);
            $j.ajax({
                url: '/color/update/' + colorID,
                type: "POST",
                data: formData,
                contentType: false, // sẽ trả về string or json Không đặt ContentType để FormData tự động xử lý data
                processData: false, // Không xử lý dữ liệu trước khi gửi
                success: function(data) {
                    $j('#listColor tbody').html(data);

                },
                error: function() {
                    console.error('Có lỗi xảy ra khi gửi dữ liệu.');
                }
            })
        }
    </script>
@endsection
