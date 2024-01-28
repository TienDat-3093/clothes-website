<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($suppliers as $sup)
            <tr>
                <td>{{ $sup->id }}</td>
                <td>{{ $sup->name }}</td>
                <td>{{ $sup->email }}</td>
                <td>{{ $sup->phone_number }}</td>
                <td>{{ $sup->address }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
