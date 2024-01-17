@foreach($listSlides as $slide)
<tr>
    <td>
        <img class="card-img" style="width: 100px;" src="{{asset($slide->url)}}" alt="Card image">

    </td>

    <td><span class="badge bg-label-warning me-1">{{$slide->status->name}}</span></td>
    <td>
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu">
                <a data-name="{{ $slide->id }}" class="dropdown-item delete-link" data-route="{{route('slideshow.delete',['id' => $slide->id])}}"><i class="bx bx-trash me-1"></i> Delete</a>
            </div>
        </div>
    </td>
</tr>
@endforeach