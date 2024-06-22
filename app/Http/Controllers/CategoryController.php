<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function store(Request $request)
    {


        $request->validate([
            'category' => 'required|string',
        ]);
        $category = new Category();
        $category->name = $request->category;
        if ($category->save()) {
            return redirect()->back()->with('success', 'Category created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create category');
        }
    }
}
