@extends('layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product Types/</span>Update</h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('product-types.update-handler', ['id' => $PDT->id]) }}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{ $PDT->name }}" class="form-control"
                                        id="basic-default-name" placeholder=" " />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone"> Status</label>
                                <div class="col-sm-10">
                                    <select name="status_id" class="form-select" id="exampleFormControlSelect1"
                                        aria-label="Default select example">
                                        {{-- @foreach ($PDT as $productTypes)
                                            <option value="{{ $productTypes->id }}"
                                                @if ($productTypes->id == $PDT->status_id) selected @endif>
                                                {{ $productTypes->name }}
                                            </option>
                                        @endforeach --}}
                                        @foreach ($STT as $status)
                                            <option value="{{ $status->id }}"
                                                @if ($status->id == $PDT->status_id) selected @endif>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Change</button>
                                    <a href="{{ route('product-types.index') }}"
                                        class="btn btn-outline-secondary">Cancel</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
