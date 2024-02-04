@foreach($listColors as $color)
<tr>
    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $color->id }}</strong></td>
    <td>{{ $color->name }}</td>

    <td>
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu">
                <button class="dropdown-item edit-button" id="edit-button" data-toggle="modal" data-target="#updateColor" data-color-id="{{ $color->id }} "><i class="bx bx-edit-alt me-1"></i> Edit</button>
            </div>
        </div>
    </td>
</tr>
@endforeach
