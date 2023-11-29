@extends('layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product Types/</span> Index </h4>
        <hr class="my-5" />
        <button type="button" class="btn btn-info"><a href="{{ route('product-types.create') }}">Add</a></button>
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @foreach ($PDT as $productTypes)
                            <tbody class="table-border-bottom-0">
                                <tr class="table-info">
                                    <td>
                                        <i class="fab fa-bootstrap fa-lg text me-3">{{$productTypes->id}}</i>
                                    </td>
                                    <td>
                                        <i class="fab fa-bootstrap fa-lg text me-3">{{$productTypes->name}}</i>
                                    </td>
                                    <td>
                                        <i class="badge bg-label-primary me-1">{{$productTypes->status->name}}</i>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('product-types.update-handler', ['id' => $productTypes->id]) }}"
                                                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                                >
                                                <a class="dropdown-item" href="{{ route('product-types.delete', ['id' => $productTypes->id]) }}"
                                                    ><i class="bx bx-trash me-1"></i> Delete</a
                                                >
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>

        <hr class="my-5" />
    </div>
@endsection