<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Product Types</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $cate)
            <tr>
                <td>{{ $cate->id }}</td>
                <td>{{ $cate->name }}</td>
                <td>{{ $cate->product_types->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
