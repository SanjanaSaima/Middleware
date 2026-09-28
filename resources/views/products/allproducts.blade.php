<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
</head>
<body>
    <form action="/products/create" method="GET">
        @csrf
        <button type="submit">Create Product</button>
    </form>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->description }}</td>
                <td>
                    <form action="/products/edit/{{ $product->id }}" method="GET">
                        @csrf
                        <button type="submit">Edit</button>
                    </form>
                    <form action="/products/delete/{{ $product->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <button type="submit"><a href="/admin/index">Back to Admin</a></button>
</body>
</html>