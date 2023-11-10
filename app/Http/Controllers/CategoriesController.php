<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
         $categories = Category::orderBy("id","desc")->paginate(10);
        return view("categories.index", ["categories"=> $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request ->validate([
            "category" =>"required|min:3|max:255",
            "color" =>"required|max:7"
        ]);
        $category = new Category();
        $category->category = $request->category;
        $category->color = $request->color;
        $category->save();
       return redirect()->route("categories.index")->with("success","Nueva Categoria agregada");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return view("categories.show", ["category"=> $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $category)
    {
        $category = Category::find($category);
        $category->category = $request->category;
        $category->color = $request->color;
        $category->save();
        return redirect()->route("categories.index")->with("success","Categoria actualizada");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $category_id)
    {
        $category = Category::find($category_id);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found');
        }

        // Eliminar tareas asociadas
        $category->tasks()->delete();

        // Eliminar la categoría
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
