<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>Full Name </th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Login At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $us)
            <tr>
                <td>{{ $us->id }}</td>
                <td>{{ $us->username }}</td>
                <td>{{ $us->fullname }}</td>
                <td>{{ $us->email }}</td>
                <td>{{ $us->address }}</td>
                <td>{{ $us->phone_number }}</td>
                <td>{{ $us->login_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
