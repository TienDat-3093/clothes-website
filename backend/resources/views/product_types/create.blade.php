@extends('layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product Types/</span>Create</h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('product-types.create-handler') }}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-name">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Name</font>
                                    </font>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                        id="basic-default-name" placeholder=" " />
                                </div>
                            </div>
                            <div class="form-text">
                                <font style="vertical-align: inherit;">
                                    @error('name')
                                        <font style="vertical-align: inherit;color:red">{{ $message }}</font>
                                    @enderror
                                </font>
                            </div>
                            <br>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <a href="{{ route('product-types.index') }}" class="btn btn-outline-secondary">Cancel</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
