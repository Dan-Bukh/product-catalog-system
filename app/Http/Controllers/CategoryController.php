<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;


class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::with('products')->get();

        return response()->json([
            'categories' => $categories,
        ]);
    }
    
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return response()->json([
            'message' => 'Category created successfully!',
            'category' => $category,
        ], 201);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $category->load('products');
        
        return response()->json([
            'category' => $category,
        ]);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->update($request->validated());

        return response()->json([
            'message' => 'Category updated successfully!',
            'category' => $category,
        ]);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully!',
        ]);
    }
}
