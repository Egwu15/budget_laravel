<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
use App\Models\Transaction;
use Livewire\WithPagination;

class TransactionItems extends Component
{
    use WithPagination;



    public function mount()
    {
    }




    public function deleteTransaction($transactionId)
    {
        $transaction = Transaction::find($transactionId);
        if ($transaction->delete()) {
            redirect()->route('dashboard')->with('success', 'Transaction deleted successfully');
            return;
        }
        redirect()->back()->with('error', 'Transaction not deleted');
    }

    public function render()
    {


        return view('livewire.layout.transaction-items', [
            'transactions' => User::with('transaction')->find(Auth::id())->transaction()->orderBy('created_at', 'desc')->with("category")->paginate(10),
        ]);
    }
}
