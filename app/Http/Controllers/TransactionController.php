<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{

    public function index()
    {
        $categories = Category::where('user_id', auth()->id())->orWhere('default', true)->get();
        return view('transaction', ["categories" => $categories]);
    }

    public function create()
    {
        $categories = Category::where('user_id', auth()->id())->orWhere('default', true)->get();
        return view('addTransaction', ["categories" => $categories]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'category_id' => 'required|numeric|exists:categories,id',
            'description' => 'required|string',
            'type' => 'required|string',
            'transaction_date' => 'required|date',
        ]);

        $validatedData['user_id'] = auth()->id();
        $transaction = new Transaction();
        $transaction->fill($validatedData);
        if ($transaction->save()) {
            return redirect()->route('transactions.index')->with('success', 'Transaction added successfully');
        }
        return redirect()->back()->with('error', 'Transaction not added');
    }
}
