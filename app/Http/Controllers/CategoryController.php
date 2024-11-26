<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json(['catwgory' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ], [
            'name.required' => 'Category name is required',
        ]);

        $categories = Category::create([
            'name' => $request->input('name'),
        ]);

        return response()->json(['message' => 'Category created successfully', 'category' => $categories]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::find($id);

        if ($categories) {
            return response()->json(['category' => $categories]);
        } else {
            return response()->json(['message' => 'Cant find category']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $categories = Category::find($id);
        if ($categories) {
            return response()->json(['category' => $categories]);
        }

        $categories->update($validatedData);
        return response()->json(['message' => 'Category updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::find($id);

        $categories->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
