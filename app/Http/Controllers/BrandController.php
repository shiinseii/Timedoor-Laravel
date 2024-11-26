<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return response()->json(['brand' => $brands]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ], [
            'name.required' => 'Brand name is required',
        ]);

        $brands = Brand::create([
            'name' => $request->input('name'),
        ]);

        return response()->json(['message' => 'Brand created successfully', 'brand' => $brands]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brands = Brand::find($id);

        if ($brands) {
            return response()->json(['brand' => $brands]);
        } else {
            return response()->json(['message' => 'Cant find brand']);
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

        $brands = Brand::find($id);
        if ($brands) {
            return response()->json(['brand' => $brands]);
        }

        $brands->update($validatedData);
        return response()->json(['message' => 'Brand updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brands = Brand::find($id);

        $brands->delete();
        return response()->json(['message' => 'Brand deleted successfully']);
    }
}
