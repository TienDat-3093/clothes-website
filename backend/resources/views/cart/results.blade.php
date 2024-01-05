@foreach ($listCart as $cart)
    <tr>
        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $cart->id }}</strong></td>
        <td>{{ $cart->total_price }}</td>
        <td>{{ $cart->users->username }}</td>
        <td>{{ $cart->discounts_id }}</td>
        @if($cart->status->id == 1)
            <td><span class="badge bg-label-primary me-1">Chờ duyệt</span></td>
        @else
            <td><span class="badge bg-label-primary me-1">Đã duyệt</span></td>
        @endif
        <td>
        <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
            <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('cart.details', ['id' => $cart->id]) }}"><i class="bx bx-detail"></i>
                    Detail</a>
                    @if($cart->status_id == 1)
                    <a data-id="{{ $cart->id }}" class="dropdown-item delete-link" data-action="duyệt"
                        data-route="{{ route('cart.verify', ['id' => $cart->id]) }}"><i class="bx bx-check-square"></i>
                        Verify</a>
                    <a data-id="{{ $cart->id }}" class="dropdown-item delete-link" data-action="xóa"
                        data-route="{{ route('cart.delete', ['id' => $cart->id]) }}"><i class="bx bx-trash"></i>
                        Delete</a>
                    @endif
            </div>
        </div>
        <td>
    </tr>
@endforeach
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-link').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                var route = this.getAttribute('data-route');
                var id = this.getAttribute('data-id');
                var action = this.getAttribute('data-action');

                Swal.fire({
                    title: 'Xác nhận?',
                    text: 'Bạn có chắc muốn ' + action + ' hóa đơn ' + id + ' không?',
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
