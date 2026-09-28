<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('categories.allcategory', compact('categories'));
    }

    public function create(){
        return view('categories.create');
    }
    
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $data = [
            'name'=> $validated['name'],
        ];

        Category::create($data);
        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    public function edit($id){
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }
    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $category = Category::find($id);
        $category->name = $validated['name'];
        $category->save();
        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
