<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Discount </title>
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
            <th>Amount</th>
            <th>Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
        </tr>
        @foreach ($data as $item)
            <tr>
                <th>{{ $item->id }}</th>
                <th>{{ $item->name }}</th>
                <th>{{ $item->amount_discounts }}</th>
                <th>{{ $item->type_discount }}</th>
                <th>{{ $item->start_date }}</th>
                <th>{{ $item->end_date }}</th>
                <th>{{ $item->status->name }}</th>
            </tr>
        @endforeach
    </table>

</body>

</html>
