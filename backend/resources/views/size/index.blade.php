@extends('layout')

@section('content')
    @include('size.modals')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sizes /</span> Index </h4>

    <div class="mt-2 d-flex align-items-center">
        <button class="btn btn-primary me-2" data-toggle="modal" data-target="#addSize">Add</button>
        <a href="{{ route('size.pdf') }}" class="btn btn-primary me-5">View PDF</a>

        <form action="{{ route('size.import-excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group" style="width: 515px">

                <input type="file" name="import_file" class="form-control">
                <br>
                <button type="submit" class="btn btn-primary me-5">Import</button>
            </div>
        </form>
        <form action="{{ route('size.export-excel') }}" method="GET">
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
        <h5 class="card-header">Sizes</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover" id="listSize">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @include('size/results')
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ asset('assets/jquery-3.7.1.min.js') }}"></script>
    <script>
        var $j = jQuery.noConflict();
        var currentSizeID;
        $j(document).ready(function() {
            $j(document).on('click', '.edit-button', function() {
                var sizeID = $j(this).data('size-id');

                console.log('size', sizeID);
                currentSizeID = null;
                currentSizeID = sizeID;
                updateSize(currentSizeID);
            });

            $j(document).on('click', '#btnCreateSize', function() {
                createSize();
                $("#createForm")[0].reset();

            });
            $j(document).on('click', '#btnUpdateSize', function() {
                updateSizeHandle(currentSizeID);
            });
        });
        $j(document).ready(function() {})
        var csrfToken = '{{ csrf_token() }}';

        function createSize() {
            var formElement = $('form#createForm')[0];
            var formData = new FormData(formElement);

            formData.append('_token', csrfToken);
            $j.ajax({
                url: "{{ route('size.create') }}",
                type: "POST",
                data: formData,
                contentType: false, // sẽ trả về string or json Không đặt ContentType để FormData tự động xử lý data
                processData: false, // Không xử lý dữ liệu trước khi gửi
                success: function(data) {
                    $j('#listSize tbody').html(data);
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

        function updateSize(sizeID) {
            $j.ajax({
                url: '/size/update/' + sizeID,
                type: "GET",
                success: function(data) {

                    $j("#updateSize #name").val(data.data.name);
                    $j("#updateSize").modal("hide");
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            })
        }

        function updateSizeHandle(sizeID) {
            var formElement = $('form#updateForm')[0];
            var formData = new FormData(formElement);

            formData.append('_token', csrfToken);
            $j.ajax({
                url: '/size/update/' + sizeID,
                type: "POST",
                data: formData,
                contentType: false, // sẽ trả về string or json Không đặt ContentType để FormData tự động xử lý data
                processData: false, // Không xử lý dữ liệu trước khi gửi
                success: function(data) {
                    $j('#listSize tbody').html(data);

                },
                error: function() {
                    console.error('Có lỗi xảy ra khi gửi dữ liệu.');
                }
            })
        }
    </script>
@endsection
