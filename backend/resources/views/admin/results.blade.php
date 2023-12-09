@foreach ($listAdmin as $admin)
    <tr>
        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $admin->id }}</strong></td>
        <td>{{ $admin->username }}</td>
        <td>{{ $admin->fullname }}</td>
        <td>{{ $admin->email }}</td>
        <td>{{ $admin->phone_number }}</td>
        <td><span class="badge bg-label-info me-1">{{ $admin->login_at }}</span></td>
        <td><span class="badge bg-label-primary me-1">{{ $admin->status->name }}</span></td>
        <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('admin.update', ['id' => $admin->id]) }}"><i
                            class="bx bx-edit-alt me-1"></i> Edit</a>
                    <a data-name="{{ $admin->username }}" class="dropdown-item delete-link"
                        data-route="{{ route('admin.delete', ['id' => $admin->id]) }}"><i class="bx bx-trash me-1"></i>
                        Lock</a>
                </div>
            </div>
        </td>
    </tr>
@endforeach
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-link').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();


                var route = this.getAttribute('data-route');
                var name = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Xác Nhận Khóa?',
                    text: 'Bạn có chắc muốn khóa tài khoản ' + name + ' không?',
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
