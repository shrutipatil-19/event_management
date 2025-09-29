<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin/Pages/Category/listCat', compact('categories'));
    }

    public function create()
    {
        return view('admin/Pages/Category/AddCategory');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'description' => $request->description,
               
        ]);

        return redirect()->route('blogs.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit( $id)
    {
        $category = category::findOrFail($id);
        return view('admin/Pages/Category/editCat', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|max:255|unique:categories,category_name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update([
            'category_name' => $request->category_name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
