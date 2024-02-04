<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sizes as $siz)
            <tr>
                <td>{{ $siz->id }}</td>
                <td>{{ $siz->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
