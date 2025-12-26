<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="page-wrapper">
    <div class="card ">
        <div class="card-header">
            <h2>
                <i class="fa-solid fa-pen-to-square"></i>
                Edit Product
            </h2>
            <p class="subtitle">Update product details below</p>
        </div>

        <form method="POST" action="{{ route('products.update', $product) }}">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title', $product->title) }}">
                @error('title')
                <div class="error-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Price and Category -->
            <div class="form-row">
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="price" value="{{ old('price', $product->price) }}">
                    @error('price')
                    <div class="error-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="category" value="{{ old('category', $product->category) }}">
                    @error('category')
                    <div class="error-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label>Description</label>
                <textarea name="description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                <div class="error-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image URL -->
            <div class="form-group">
                <label>Image URL</label>
                <input type="text" name="image_url" value="{{ old('image_url', $product->image_url) }}">
                @error('image_url')
                <div class="error-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Rating Rate and Rating Count -->
            <div class="form-row">
                <div class="form-group">
                    <label>Rating</label>
                    <input type="text" name="rating_rate" value="{{ old('rating_rate', $product->rating_rate) }}">
                    @error('rating_rate')
                    <div class="error-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Rating Count</label>
                    <input type="text" name="rating_count" value="{{ old('rating_count', $product->rating_count) }}">
                    @error('rating_count')
                    <div class="error-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('products.index') }}" class="btn-secondary">
                    Cancel
                </a>

                <button type="submit" class="btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Update Product
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
