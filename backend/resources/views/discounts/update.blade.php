@extends('layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Discounts /</span>Update</h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('discounts.update-handler', ['id' => $categories->id]) }}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{ $discounts->name }}" class="form-control"
                                        id="basic-default-name" placeholder=" " />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Amount Discounts</label>
                                <div class="col-sm-10">
                                    <input type="text" name="amount_discounts" value="{{ $discounts->amount_discounts }}"
                                        class="form-control" id="basic-default-name" placeholder=" " />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Type Discounts</label>
                                <div class="col-sm-10">
                                    <input type="text" name="type_discount" value="{{ $discounts->type_discount }}"
                                        class="form-control" id="basic-default-name" placeholder=" " />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Start Date</label>
                                <div class="col-sm-10">
                                    <input type="text" name="start_date" value="{{ $discounts->start_date }}"
                                        class="form-control" id="basic-default-name" placeholder=" " />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">End Date</label>
                                <div class="col-sm-10">
                                    <input type="text" name="end_date" value="{{ $discounts->end_date }}"
                                        class="form-control" id="basic-default-name" placeholder=" " />
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">

                                    <button type="submit" class="btn btn-primary">Change</button>
                                    <a href="{{ route('discounts.index') }}" class="btn btn-outline-secondary">Cancel</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
