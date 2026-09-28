<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Category</title>
</head>
<body>
    <h1>All Categories</h1>
    <form action="/category/create" method="GET">
        @csrf
        <button type="submit">Add Category</button>
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <form action="/category/edit/{{ $category->id }}" method="GET">
                        @csrf
                        <button type="submit">Edit</button>
                    </form>
                    <form action="/category/delete/{{ $category->id }}" method="POST">
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