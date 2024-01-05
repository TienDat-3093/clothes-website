@extends('layout').

@section('content')
@include('product.modals')

<div class="mt-2 d-flex align-items-center">
    <button class="btn btn-primary me-2" data-toggle="modal" data-target="#addModal">Add</button>
    <!-- <a href="{{ route('product.create') }}" class="btn btn-primary me-2">Add</a> -->
    <div class="input-group input-group-merge">
        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
        <input type="text" id="searchInput" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
    </div>
    
   
</div>
<br>
<div class="card">


    <h5 class="card-header">List Product</h5>
    <div class="table-responsive text-nowrap">

        <table class="table table-hover" id="listProduct">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>IMAGES</th>
                    <th>DESCRIPTION</th>
                    <th>PRICE</th>
                    <th>STAR AVG</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>

                </tr>
            </thead>
            <tbody class="table-border-bottom-0">

                @include('product/results')

            </tbody>
        </table>

    </div>

</div>
<br>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        @if ($listProduct->onFirstPage())
        <li class="page-item disabled">
            <span class="page-link" aria-hidden="true">Previous</span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $listProduct->previousPageUrl() }}" rel="prev">Previous</a>
        </li>
        @endif

        @foreach ($listProduct->getUrlRange(1, $listProduct->lastPage()) as $page => $url)
        @if ($page == $listProduct->currentPage())
        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach

        @if ($listProduct->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $listProduct->nextPageUrl() }}" rel="next">Next</a>
        </li>
        @else
        <li class="page-item disabled" aria-disabled="true">
            <span class="page-link" aria-hidden="true">Next</span>
        </li>
        @endif
    </ul>
</nav>

<script src="{{asset('assets/jquery-3.7.1.min.js')}}"></script>
<script>
    var $j = jQuery.noConflict();
    $j(document).ready(function() {
        $j('#searchInput').on('keyup', function(event) {
            if (event.key === 'Enter') {
                
                searchProducts();
                
            }
        });
        $j('#btnCreateProduct').click(function() {
            createProduct();

            $("#createForm")[0].reset();
        });
        $j('#btnResetPagination').click(function() {
            resetPagination();
        });
    });
    var csrfToken = '{{ csrf_token() }}';

    function resetPagination() {
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.set('page', 1);
        window.location.href = currentURL.toString();
    }

    function createProduct() {
        var formElement = $('form#createForm')[0];
        var formData = new FormData(formElement);
        formData.append('_token', csrfToken);
        $j.ajax({
            url: "{{route('product.create')}}",
            type: "POST",
            data: formData,
            contentType: false, // sẽ trả về string or json Không đặt ContentType để FormData tự động xử lý data
            processData: false, // Không xử lý dữ liệu trước khi gửi
            success: function(data) {
                $j('#listProduct tbody').html(data);

            },
            error: function() {
                console.error('Có lỗi xảy ra khi gửi dữ liệu.');
            }
        });


    };

    function searchProducts() {
        let keyword = $('#searchInput').val();
        $j.ajax({
            url: "{{ route('product.search') }}",
            type: 'POST',
            data: {
                data: keyword,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                
                $j('#listProduct tbody').html(data);

            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function updateHandleProduct(productID) {

        var formElement = $('form#updateForm')[0];
        var formData = new FormData(formElement);
        formData.append('_token', csrfToken);
        /* console.log(formData.get('images[]'));
        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        } */
        console.log("id product:" + productID);
        $j.ajax({
            url: "/product/update/" + productID,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log("Success:", data);
                $j('#listProduct tbody').html(data);
                resetPagination();
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);

            }

        })
    }
</script>
@endsection