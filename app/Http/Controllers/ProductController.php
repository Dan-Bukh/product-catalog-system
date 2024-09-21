<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {
        $products = Product::with('category')
        //Сортировка по категории
        ->when($category_id = $request->input('category_id'), function ($query) use ($category_id) {
            $query->where('category_id', $category_id);
        })
        //Сортировка по цене (возрастанию(asc) / убыванию (desc))
        ->when($orderBy = $request->input('orderBy'), function ($query) use ($orderBy) {
            $query->orderBy('price', $orderBy);
        })
        //Поиск
        ->when($search = $request->input('search'), function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->paginate(3)->withQueryString();

        return response()->json([
            'products' => $products,
        ]);
    }
    
    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());

        return response()->json([
            'message' => 'Product created successfully!',
            'product' => $product,
        ], 201);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $product->load('category');

        return response()->json([
            'product' => $product,
        ]);
    }

    public function update(ProductUpdateRequest $request, $id)
    {

        $product = Product::findOrFail($id);

        $product->update($request->validated());

        return response()->json([
            'message' => 'Product updated successfully!',
            'product' => $product,
        ]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully!',
        ]);
    }
}
