<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function store(Request $request)
    {

        if (!Auth::check()) {
            return redirect()->route('home');
        }


        $request->validate([
            'category' => 'required|string',
        ]);
        $category = new Category();
        $category->name = $request->category;
        $category->default = false;
        $category->user_id = auth()->id();

        if ($category->save()) {
            return redirect()->back()->with('success', 'Category created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create category');
        }
    }
}
