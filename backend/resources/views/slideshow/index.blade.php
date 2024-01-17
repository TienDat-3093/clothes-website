@extends('layout')

@section('content')
@include('slideshow.modal')
<div class="mt-2 d-flex align-items-center">
    <button class="btn btn-primary me-2" data-toggle="modal" data-target="#addModal">Add</button>
</div>
<br>
<div class="card">
    <h5 class="card-header">SlideShow</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover" id="listSlideShow">
            <thead>
                <tr>
                    <th>URL</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @include('slideshow/results')
            </tbody>
        </table>
    </div>
</div>
<script src="{{asset('assets/jquery-3.7.1.min.js')}}"></script>
<script>
    var $j = jQuery.noConflict();
    $j(document).ready(function() {
        $j('#btnCreateSlideShow').click(function() {
            createSlideShow();
        })
    });
    var csrfToken = '{{ csrf_token() }}';

    function createSlideShow() {
        var formElement = $('form#createForm')[0];
        var formData = new FormData(formElement);

        formData.append('_token', csrfToken);
        $j.ajax({
            url: "{{ route('slideshow.create')}}",
            type: "POST",
            data: formData,
            contentType: false, // sẽ trả về string or json Không đặt ContentType để FormData tự động xử lý data
            processData: false, // Không xử lý dữ liệu trước khi gửi
            success: function(data) {
                $j('#listSlideShow tbody').html(data);

            },
            error: function() {
                console.error('Có lỗi xảy ra khi gửi dữ liệu.');
            }
        })
    }
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-link').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();


                var route = this.getAttribute('data-route');
                var name = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Xác Nhận Xóa?',
                    text: 'Bạn có chắc muốn xóa ' + name + ' không?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy bỏ',
                }).then(function(result) {
                    if (result.isConfirmed) {
                        window.location.href = route;
                    }
                });
            });
        });

    });
</script>
@endsection