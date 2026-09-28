<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>

<body>

    <h1>Order Details</h1>

    <p>Order ID: {{ $order->id }}</p>

    <p>Total Price: {{ $order->total_price }}</p>

    <h3>Products</h3>

    @foreach ($order->orderItems as $item)

        <p>
            Product Name:
            {{ $item->product->name }}
        </p>

        <p>
            Quantity:
            {{ $item->quantity }}
        </p>

        <p>
            Price:
            {{ $item->price }}
        </p>

        <p>
            Product Total:
            {{ $item->price * $item->quantity }}
        </p>

        <hr>

    @endforeach

    <a href="{{ route('products.index') }}">
        Back to Products
    </a>

</body>
</html>