@extends('layout')


@section('content')
    <a href="{{ route('import.index') }}" class="btn btn-primary">Back</a>
    <table class="table" id="listUser">
        <thead>
            <tr>
                <th>Id</th>
                <th>Product</th>
                <th>Color</th>
                <th>Size</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach ($listImportDetails as $detail)
            <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $detail->id }}</strong></td>
                <td>{{ $detail->products->name }}</td>
                <td>{{ $detail->colors->name }}</td>
                <td>{{ $detail->sizes->name }}</td>
                <td>{{ $detail->price }}</td>
                <td>{{ $detail->quantity }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
