<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Imports</title>
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
            <th>Total Price</th>
            <th>Admin</th>
            <th>Supplier</th>
            <th>Status</th>
        </tr>
        @foreach ($data as $item)
            <tr>
                <th>{{ $item->id }}</th>
                <th>{{ $item->total_price }}</th>
                <th>{{ $item->admins->username }}</th>
                <th>{{ $item->suppliers->name }}</th>
                <th>{{ $item->status->name }}</th>
            </tr>
        @endforeach
    </table>

</body>

</html>
