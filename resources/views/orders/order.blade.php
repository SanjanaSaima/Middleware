<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page</title>
</head>

<body>

    <h1>Order Page</h1>

    <p>Product: {{ $product->name }}</p>

    <p>Price: {{ $product->price }}</p>

    <form action="{{ route('order.store') }}" method="POST">
        @csrf

        <input
            type="hidden"
            name="product_id"
            value="{{ $product->id }}"
        >

        <label>Quantity:</label>

        <input
            type="number"
            name="quantity"
            value="1"
            min="1"
        >

        <button type="submit">
            Confirm Order
        </button>
    </form>

    <a href="{{ route('products.index') }}">
        Back to Products
    </a>

</body>
</html>