<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>      
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="/products/store" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <br>
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <br>
        <label for="price">Price</label>
        <input type="number" name="price" id="price">
        <br>
        <label for="description">Description</label>
        <input type="text" name="description" id="description">
        <br>
        <button type="submit">Submit</button>
    </form>

    <button type="submit"><a href="/admin/index">Back to Admin</a></button>
</body>
</html>