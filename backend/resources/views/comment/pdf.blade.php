<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Comment </title>
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
            <th>Content</th>
            <th>Rating</th>
            <th>User</th>
            <th>Product</th>
            <th>Status</th>
        </tr>
        @foreach ($data as $item)
            <tr>
                <th>{{ $item->id }}</th>
                <th>{{ $item->content }}</th>
                <th>{{ $item->ratings }}</th>
                <th>{{ $item->users->username }}</th>
                <th>{{ $item->products->name }}</th>
                <th>{{ $item->status->name }}</th>
            </tr>
        @endforeach
    </table>

</body>

</html>
