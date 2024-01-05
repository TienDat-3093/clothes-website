@foreach ($listUser as $user)
    <tr>
        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $user->id }}</strong></td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->fullname }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone_number }}</td>
        <td><span class="badge bg-label-info me-1">{{ $user->login_at }}</span></td>
        <td><span class="badge bg-label-primary me-1">{{ $user->status->name }}</span></td>
        <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    @if($user->status->id == 2)
                    <a data-action="mở khóa" data-name="{{ $user->username }}" class="dropdown-item delete-link"
                        data-route="{{ route('user.delete', ['id' => $user->id]) }}"><i class="bx bx-lock-open-alt"></i>
                        Unlock</a>
                    @else
                    <a data-action="khóa" data-name="{{ $user->username }}" class="dropdown-item delete-link"
                        data-route="{{ route('user.delete', ['id' => $user->id]) }}"><i class="bx bx-lock-alt"></i>
                        Lock</a>
                    @endif
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
                var action = this.getAttribute('data-action');

                Swal.fire({
                    title: 'Xác nhận '+ action +'?',
                    text: 'Bạn có chắc muốn ' + action + ' tài khoản ' + name + ' không?',
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
