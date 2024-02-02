<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Star</th>
            <th>Categories</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $pro)
            <tr>
                <td>{{ $pro->id }}</td>
                <td>{{ $pro->name }}</td>
                <td>{{ $pro->description }}</td>
                <td>{{ $pro->price }}</td>
                <td>{{ $pro->star_avg }}</td>
                <td>{{ $pro->category->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
