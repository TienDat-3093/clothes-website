@foreach ($listComment as $comment)
    <tr>
        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $comment->id }}</strong></td>
        <td>{{ $comment->content }}</td>
        <td>{{ $comment->ratings }}</td>
        <td>{{ $comment->users->username }}</td>
        <td>{{ $comment->products->name }}</td>
        <td><span class="badge bg-label-primary me-1">{{ $comment->status->name }}</span></td>
        <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    @if($comment->status->id == 1)
                    <a data-action="xóa" data-id="{{ $comment->id }}" class="dropdown-item delete-link"
                        data-route="{{ route('comment.delete', ['id' => $comment->id]) }}"><i class="bx bx-trash"></i>
                        Delete</a>
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
                var id = this.getAttribute('data-id');
                var action = this.getAttribute('data-action');

                Swal.fire({
                    title: 'Xác nhận '+ action +'?',
                    text: 'Bạn có chắc muốn ' + action + ' comment ' + id + ' không?',
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
