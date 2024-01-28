<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Total Price</th>
            <th>Users</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($carts as $cart)
            <tr>
                <td>{{ $cart->id }}</td>
                <td>{{ $cart->total_price }}</td>
                <td>{{ $cart->users->username }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
