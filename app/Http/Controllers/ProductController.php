<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(){
        $products= Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function indexapi(){
        $products= Product::with('category')->get();
        return response()->json($products);
    }

    public function allproducts(){
        $products = Product::with('category')->get();
        return view('products.allproducts', compact('products'));
    }

    public function create(){
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        $data = [
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
        ];

        Product::create($data);
        return redirect()->route('products.allproducts')->with('success', 'Product created successfully');
    }

    public function edit($id){
        $categories = Category::all();
        $product = Product::find($id);
        return view('products.edit', compact('categories', 'product'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        $data = [
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
        ];

        Product::where('id', $id)->update($data);
        return redirect()->route('products.allproducts')->with('success', 'Product updated successfully');
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.allproducts')->with('success', 'Product deleted successfully');
    }
}
