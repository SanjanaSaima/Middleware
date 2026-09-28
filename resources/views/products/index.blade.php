<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Index</title>
</head>
<body>
    <h1>Products Showcasing</h1>
    <nav>
        <a href="/signup"> Sign UP</a>
        <a href="/login"> Login </a>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th> 
                <th>Description</th>  
                <th>Action</th>
            </tr>
</thead>
<tbody>
    @foreach ($products as $product)
    <tr>
        <td>{{$product->id}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->category_name}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->description}}</td>
        <td>
            <form action="/order/{{$product->id}}" method="GET">
                @csrf
                <button type="submit">Buy Product</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>

    </table>

</body>
</html>