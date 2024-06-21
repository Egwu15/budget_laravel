<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Transaction;

class transactionController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'category_id' => 'required|numeric',
            'description' => 'required|string',
            'type' => 'required|string',
        ]);


        $transaction = new Transaction();
        $transaction->fill($validatedData);
        $transaction->save();
    }

    public function create()
    {
        $categories = Category::all();
        return view('addTransaction', ["categories" => $categories]);
    }
}
