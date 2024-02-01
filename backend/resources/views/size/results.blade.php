@foreach($listSizes as $size)
<tr>
    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $size->id }}</strong></td>
    <td>{{ $size->name }}</td>

    <td>
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu">
                <button class="dropdown-item edit-button" id="edit-button" data-toggle="modal" data-target="#updateSize" data-size-id="{{ $size->id }} "><i class="bx bx-edit-alt me-1"></i> Edit</button>
            </div>
        </div>
    </td>
</tr>
@endforeach
