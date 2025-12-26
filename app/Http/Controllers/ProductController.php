<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        //$products = Product::paginate(5);
        return view('products.index', compact('products'));
    }

    public function fetch()
    {
        // Fetch products from the API
        $response = Http::get('https://fakestoreapi.com/products');

        if (!$response->successful()) {
            return back()->with('error', 'Failed to fetch products');
        }

        $fetchedCount = 0; // Counter for new products

        foreach ($response->json() as $item) {
            $product = Product::where('api_id', $item['id'])->first();

            if (!$product) {
                Product::create([
                    'api_id' => $item['id'],
                    'title' => $item['title'],
                    'price' => $item['price'],
                    'description' => $item['description'],
                    'category' => $item['category'],
                    'image_url' => $item['image'],
                    'rating_rate' => $item['rating']['rate'] ?? null,
                    'rating_count' => $item['rating']['count'] ?? null,
                ]);

                $fetchedCount++;
            }
        }

        if ($fetchedCount > 1) {
            $message = "$fetchedCount new products fetched successfully";
        } elseif ($fetchedCount === 1) {
            $message = "1 new product fetched successfully";
        } else {
            $message = "No new product available to fetch.";
            return redirect()->route('products.index')->with('error', $message);
        }

        return redirect()->route('products.index')->with('success', $message);
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'image_url' => 'required|url',
            'rating_rate' => ['required', 'numeric', 'min:0', 'max:5', 'regex:/^\d(\.\d{1})?$|^5(\.0)?$/'],
            'rating_count' => 'required|integer|min:0',
        ], [
            'title.required' => 'Title is required.',
            'price.required' => 'Price cannot be empty.',
            'price.numeric' => 'Price must be a number.',
            'price.min' => 'Price cannot be negative.',
            'price.regex' => 'Price can have up to 2 decimal places.',
            'description.required' => 'Description is required.',
            'category.required' => 'Category is required.',
            'image_url.required' => 'Image URL is required.',
            'image_url.url' => 'Please enter a valid URL.',
            'rating_rate.required' => 'Rating is required.',
            'rating_rate.numeric' => 'Rating must be a number.',
            'rating_rate.min' => 'Rating cannot be negative.',
            'rating_rate.max' => 'Rating cannot be more than 5.',
            'rating_rate.regex' => 'Rating can have 1 decimal place.',
            'rating_count.required' => 'Rating count is required.',
            'rating_count.integer' => 'Rating count must be a whole number.',
            'rating_count.min' => 'Rating count cannot be negative.',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }

}
