<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Total Price</th>
            <th>Admins</th>
            <th>Suppliers</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($imports as $imp)
            <tr>
                <td>{{ $imp->id }}</td>
                <td>{{ $imp->total_price }}</td>
                <td>{{ $imp->admins->username }}</td>
                <td>{{ $imp->suppliers->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
