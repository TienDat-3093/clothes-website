<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Products</title>
    <style>
        * {
            font-family: DejaVu Sans, sans-serif;
        }

        body {
            font-size: 14px;
        }

        td,
        th {
            vertical-align: middle;
            text-align: center;
            padding: 5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
    </style>
</head>

<body>
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            {{-- <th>Quantity</th>
            <th>Color</th> --}}
            <th>Description</th>
            <th>Price</th>
            <th>Start</th>
            <th>Categories</th>
            <th>Status</th>
        </tr>
        @foreach ($data as $item)
            <tr>
                <th>{{ $item->id }}</th>
                <th>{{ $item->name }}</th>
                {{-- <th>{{ $item->productDetail->quantity }}</th> --}}
                {{-- <th>{{ $item->productDetail->colors->name }}</th>
                <th>{{ $item->productDetail->sizes->name }}</th> --}}
                <th>{{ $item->description }}</th>
                <th>{{ $item->price }}</th>
                <th>{{ $item->star_avg }}</th>
                <th>{{ $item->category->name }}</th>
                <th>{{ $item->status->name }}</th>
            </tr>
        @endforeach
    </table>

</body>

</html>
