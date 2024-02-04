<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($colors as $col)
            <tr>
                <td>{{ $col->id }}</td>
                <td>{{ $col->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
