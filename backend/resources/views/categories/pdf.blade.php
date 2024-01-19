<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Categories</title>
    <style>
        * {
            font-family: DejaVu Sans, sans-serif;
        }

        body {
            font-size: 12px;
        }

        td {
            vertical-align: middle;
            text-align: center;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Product Type</th>
            <th>Status</th>
        </tr>
        @foreach ($categories as $cate)
            <tr>
                <th>{{ $cate->id }}</th>
                <th>{{ $cate->name }}</th>
                <th>{{ $cate->product_types->name }}</th>
                <th>{{ $cate->status->name }}</th>
            </tr>
        @endforeach
    </table>

</body>

</html>
