<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Index</title>
</head>

<body>
<nav>
    <a href="/category/allcategory">All Categories</a>
    <a href="/products/allproducts">All Products</a>
</nav>

<h1>Orders</h1>

<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Product Name</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach ($orders as $order)

            <tr>
                <td>{{ $order->id }}</td>

                <td>{{ $order->user_id }}</td>

                 <td>
            @foreach ($order->orderItems as $item)
                {{ $item->product->name }}
            @endforeach
        </td>

                <td>
                    <form action="/order/details/{{$order->id}}" method="GET">
                        @csrf
                        <button type="submit">View order details</button>
                    </form>
                </td>
            </tr>

        @endforeach

    </tbody>
</table>

</body>
</html>
