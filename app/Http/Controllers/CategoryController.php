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
        return Category::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|max:20|unique:categories',
        ]);
        return Category::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category , $id)
    {
        return Category::with(relations: ['sessions'])->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category , $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'category_name' => 'required|max:20|unique:categories,category_name,' . $category->id,
        ]);
        $category->update($request->all());
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category ,$id)
    {
        $category = Category::findOrFail($id);

        if ($category->sessions()->exists()) {
            return response()->json([
                'message' => 'Cannot delete category with sessions'
            ], 422);
        }

        $category->delete();
        return response()->noContent();
    }
}