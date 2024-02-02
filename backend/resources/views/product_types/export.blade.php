<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($product_types as $pro_ty)
            <tr>
                <td>{{ $pro_ty->id }}</td>
                <td>{{ $pro_ty->name }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
