@extends('layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Categories /</span>Create</h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('categories.create-handler') }}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="basic-default-name"
                                        placeholder=" " />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone"> Product Types</label>
                                <div class="col-sm-10">
                                    <select name="product_types_id" class="form-select" id="exampleFormControlSelect1"
                                        aria-label="Default select example">
                                        @foreach ($productTypes as $pro)
                                            <option value="{{ $pro->id  }}">{{$pro->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection