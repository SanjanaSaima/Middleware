<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    @if($errors->any())
        <div style="color:red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div style="color:green">
            {{ session('success') }}
        </div>
    @endif

    <form action="/products/update/{{ $product->id }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ $product->name }}">
        <br>
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        <br>    
        <label for="price">Price</label>
        <input type="number" name="price" id="price" value="{{ $product->price }}">
        <br>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" value="{{ $product->description }}">
        <br>
        <button type="submit">Update</button>
    </form>

    <button type="submit"><a href="/admin/index">Back to Admin</a></button>
</body>
</html>