<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>Full Name </th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Last Login</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admins as $ad)
            <tr>
                <td>{{ $ad->id }}</td>
                <td>{{ $ad->username }}</td>
                <td>{{ $ad->fullname }}</td>
                <td>{{ $ad->email }}</td>
                <td>{{ $ad->phone_number }}</td>
                <td>{{ $ad->login_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
