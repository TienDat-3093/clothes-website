@foreach ($listProductTypes as $pro)
    <tr>
        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $pro->id }}</strong></td>
        <td>{{ $pro->name }}</td>
        <td><span class="badge bg-label-primary me-1">{{ $pro->status->name }}</span></td>
        <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('product-types.update', ['id' => $pro->id]) }}"><i
                            class="bx bx-edit-alt me-1"></i> Edit</a>
                    <a data-name="{{ $pro->name }}" class="dropdown-item delete-link"
                        data-route="{{ route('product-types.delete', ['id' => $pro->id]) }}"><i
                            class="bx bx-trash me-1"></i> Delete</a>
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
