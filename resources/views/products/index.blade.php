<!DOCTYPE html>
<html>
<head> <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management System</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<div class="header">
    <h2 class="page-title">
        <i class="fa-solid fa-box"></i>
        Product List
    </h2>
    <a class="fetch-btn" href="{{ route('products.fetch') }}">Fetch Products</a>
</div>

@if(session('success'))
    <div class="toaster success" id="toaster">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="toaster error" id="toaster">{{ session('error') }}</div>
@endif



<table>
    <tr>
        <th>Title</th>
        <th>Price</th>
        <th>Description</th>
        <th>Category</th>
        <th>Image</th>
        <th>Rating</th>
        <th>Rating Count</th>
        <th>Actions</th>
    </tr>

    @foreach($products as $product)
        <tr>
            <td>{{ $product->title }}</td>
            <td>${{ $product->price }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->category }}</td>
            <td><img src="{{ $product->image_url }}" alt="{{ $product->title }}"></td>
            <td>{{ $product->rating_rate }}</td>
            <td>{{ $product->rating_count }}</td>
            <td class="actions">
                <a href="{{ route('products.edit', $product) }}">Edit</a>
                <form method="POST" action="{{ route('products.destroy', $product) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const toaster = document.getElementById('toaster');
        if(toaster) {
            toaster.classList.add('show');
            setTimeout(() => {
                toaster.classList.remove('show');
            }, 3000);
        }
    });
</script>

</body>
</html>
