


@foreach($listProduct as $product)
<tr>
    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$product->id}}</strong></td>
    <td>{{$product->name}}</td>
    <td>
        @if(!empty($productImage))
        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
            @foreach($productImage as $image)
            @if($image->products_id == $product->id)
            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Lilian Fuller">
                <img src="{{asset($image->url)}}" alt="Avatar" class="rounded-circle">
            </li>
            @endif
            @endforeach
        </ul>
        @else
        <p>Không có ảnh cho sản phẩm này</p>
        @endif
    </td>
    <td>{{$product->description}}</td>
    <td>{{$product->import_price}}</td>
    <td>{{$product->sales_price}}</td>
    <td>
        @if(!empty($product->star_avg))
        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
            @for($i=1;$i<=$product->star_avg;$i++)
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Lilian Fuller">
                    <i class='bx bxs-star' style="color:yellow"></i>
                </li>
                @endfor
        </ul>
        @endif
    </td>
    <!-- <td><span class="badge bg-label-primary me-1">{{$product->status->name}}</span></td> -->
    <td>
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('product.detail',['id' => $product->id])}}"  ><i class="bx bx bx-detail me-1" ></i> Detail</a>
                <a class="dropdown-item" href="{{route('product.update',['id' => $product->id])}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a data-name="{{ $product->name }}" class="dropdown-item delete-link" data-route="{{route('product.delete',['id' => $product->id])}}"><i class="bx bx-trash me-1"></i> Delete</a>
            </div>
        </div>
    </td>
</tr>

<script>
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

@endforeach