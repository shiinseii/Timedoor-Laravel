<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        

        // $query = Product::query();

        // if ($keyword) {
        //     $query->where('name', 'like', "%{$keyword}%");
        // }

        // $products = Product::paginate(10);
        // $products = $query->get();
        // return response()->json(['products' => $products]);

        // $keyword = $request->input('keyword');

        // $products = new Product;

        // if ($keyword) {
        // $products = $products->where('name', 'like', "%{$keyword}%");
        // }

        // $result = $products->orderBy('price', 'desc')->paginate(5);

        // return response()->json($result);

        $query = Product::query();
        $keyword = $request->get('keyword', '');
        $category_name = $request->get('category_name');
        $brand_name = $request->get('brand_name');

        if ($keyword) {
        $query = $query->where('name', 'like', "%{$keyword}%");
        }

        if ($category_name) {
            $query->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->where('categories.name', 'like', "%{$category_name}%");
        }
        if ($brand_name) {
            $query->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'brands.name as brand_name')
            ->where('brands.name', 'like', "%{$brand_name}%");
        }

        $products = $query->orderBy('name')->paginate(10);

        return response()->json($products);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required',
            'brand_id' => 'required',
        ], [
            'name.required' => 'Product name is required',
            'price.required' => 'Product price is required',
            'price.numeric' => 'Product price must be a numeric',
            'stock.required' => 'Product stock is required',
            'stock.integer' => 'Product stock must be an integer',
            'category_id.required' => 'Product category is required',
            'brand_id.required' => 'Product brand is required',
            
        ]);

        $products = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
        ], 201);

        if (!$products) {
            return response()->json(['message' => 'Error Creating Products'], 500);
        }

        return response()->json(['message' => 'Product Created Successfully', 'product' => $products]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::find($id);

        if ($products) {
            return response()->json(['product' => $products]);
        } else {
            return response()->json(['message' => 'Cant Find Product']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);

        $products = Product::find($id);
        if (!$products) {
            return response()->json(['message' => 'Cant Find Products'], 404);
        }

        $products->update($validatedData);
        return response()->json(['message' => 'Product Updated Successfully', 'product' => $products]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products = Product::find($id);

        if (!$products) {
            return response()->json(['message' => 'Cant Find The Product'], 404);
        }

        $products->delete();
        return response()->json(['message' => 'Product Deleted Successfully']);
    }
}
