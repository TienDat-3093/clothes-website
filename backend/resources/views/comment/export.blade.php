<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Content</th>
            <th>Ratings</th>
            <th>Users</th>
            <th>Product</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($comments as $com)
            <tr>
                <td>{{ $com->id }}</td>
                <td>{{ $com->content }}</td>
                <td>{{ $com->ratings }}</td>
                <td>{{ $com->users->username }}</td>
                <td>{{ $com->products->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
