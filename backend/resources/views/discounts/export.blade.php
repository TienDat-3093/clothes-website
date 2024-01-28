<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Amount Discounts</th>
            <th>Type Discounts</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($discounts as $dis)
            <tr>
                <td>{{ $dis->id }}</td>
                <td>{{ $dis->name }}</td>
                <td>{{ $dis->amount_discounts }}</td>
                <td>{{ $dis->type_discount }}</td>
                <td>{{ $dis->start_date }}</td>
                <td>{{ $dis->end_date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
