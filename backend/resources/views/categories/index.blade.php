@extends('layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Categories /</span> Index </h4>
        <hr class="my-5" />

        <a href="{{ route('categories.create') }}" class="btn btn-primary me-2">Add</a>

        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Product Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @foreach ($categories as $cate)
                        <tbody class="table-border-bottom-0">
                            <tr class="table-active">
                                <td>
                                    <i class="fab fa-bootstrap fa-lg text me-3">{{ $cate->id }}</i>
                                </td>
                                <td>
                                    <i class="fab fa-react fa-lg text-info me-3"></i>
                                    <strong>{{ $cate->name }}</strong>
                                </td>
                                <td>
                                    <span class="fab fa-react fa-lg text me-3">{{ $cate->product_types->name }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-label-primary me-1">{{ $cate->status->name }}</span>
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('categories.update-handler', ['id' => $cate->id]) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="dropdown-item"
                                                href="{{ route('categories.delete', ['id' => $cate->id]) }}"><i
                                                    class="bx bx-trash me-1"></i> Delete</a>
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