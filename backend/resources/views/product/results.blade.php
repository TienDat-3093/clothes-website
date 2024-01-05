



@foreach($listProduct as $product)
<tr data-product-id="{$product->id}">
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
    <td>{{$product->price}}</td>
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
    <td><span class="badge bg-label-primary me-1">{{$product->status->name}}</span></td>
    <td>
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('product.detail',['id' => $product->id])}}"><i class="bx bx bx-detail me-1"></i> Detail</a>
                <button class="dropdown-item edit-button" id="edit-button" data-toggle="modal" data-target="#updateModal" data-product-id="{{ $product->id }} "><i class="bx bx-edit-alt me-1"></i> Edit</button>
                <a data-name="{{ $product->name }}" class="dropdown-item delete-link" data-route="{{route('product.delete',['id' => $product->id])}}"><i class="bx bx-trash me-1"></i> Delete</a>
            </div>
        </div>
    </td>
</tr>
@endforeach
<script src="{{asset('assets/jquery-3.7.1.min.js')}}"></script>
<script>
    var $j = jQuery.noConflict();
    var currentProductId;
    $j(document).ready(function() {

        $j('.edit-button').click(function() {

            var productID = $j(this).data('product-id');
            console.log(productID);
            currentProductId = productID;
            updateProduct(productID);




        })
        $j('#btnUpdateProduct').click(function() {
            updateHandleProduct(currentProductId);
            document.getElementById('images').value = '';
        })
        $j('#btnDeleteImage').click(function() {
            deleteImage();
        })
    });


    function deleteImage() {
        var selectImages = $j('.delete-image-checkbox:checked');
        var imagesToDelete = [];
        if (selectImages.length != 0) {
            selectImages.each(function() {
                imagesToDelete.push($j(this).val());
            });
        }
        $j.ajax({
            url: "{{route('product.deleteImage')}}",
            type: "POST",
            data: {
                imageIds: imagesToDelete,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {

                console.log(response);
                imagesToDelete.forEach(function(imageID) {
                    $j('#imageContainer img[data-image-id="' + imageID + '"]').parent().remove();
                });
                imagesToDelete = [];
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function updateProduct(productID) {
        $j.ajax({
            url: '/product/update/' + productID,
            type: "GET",
            success: function(data) {
                console.log(data.data_detail)
                $j("#name").val(data.data.name);
                $j("#description").val(data.data.description);
                $j("#price").val(data.data.price);
                $j("#categories").val(data.data.categories_id);

                var imagesContainer = $j('#imageContainer');
                imagesContainer.empty();
                if (data.data_image.length > 0) {
                    data.data_image.forEach(function(image) {
                        var checkbox = $j('<input type="checkbox" class="delete-image-checkbox" name="deleteImages[]" value="' + image.id + '">');
                        var imgElement = $j('<img src="' + image.url + '" alt="Product Image" class="w-25 p-1 delImage" data-image-id="' + image.id + '">');
                        imagesContainer.append($j('<div >').append(checkbox).append(imgElement));
                    });
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }

        })
    }
    var csrfToken = '{{ csrf_token() }}';

    

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