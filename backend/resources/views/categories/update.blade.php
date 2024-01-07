@extends('layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Categories /</span>Update</h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('categories.update-handler', ['id' => $categories->id]) }}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{ $categories->name }}"
                                        class="form-control" id="basic-default-name" placeholder=" " />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone"> Product Type</label>
                                <div class="col-sm-10">
                                    <select name="product_types_id" class="form-select" id="exampleFormControlSelect1"
                                        aria-label="Default select example">
                                        @foreach ($productTypes as $pro)
                                            <option value="{{ $pro->id }}"
                                                @if ($pro->id == $categories->product_types_id) selected @endif>
                                                {{ $pro->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone"> Status</label>
                                <div class="col-sm-10">
                                    <select name="status_id" class="form-select" id="exampleFormControlSelect1"
                                        aria-label="Default select example">
                                        @foreach ($status as $sta)
                                            <option value="{{ $sta->id }}"
                                                @if ($sta->id == $categories->status_id) selected @endif>
                                                {{ $sta->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">

                                    <button type="submit" class="btn btn-primary">Change</button>
                                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Cancel</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
