<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
use App\Models\Transaction;
use Livewire\WithPagination;

class DashboardItems extends Component
{
    use WithPagination;

    public $deleteTransactionId;
    public $showDeleteTransactionPopup = false;

    public function mount()
    {
    }

    public function closeDeleteTransactionPopup()
    {
        $this->showDeleteTransactionPopup = false;
    }

    public function setDeleteTransactionId($transactionId)
    {
        $this->deleteTransactionId = $transactionId;
        $this->showDeleteTransactionPopup = true;
    }


    public function deleteTransaction()
    {
        $transaction = Transaction::find($this->deleteTransactionId);
        if ($transaction->delete()) {
            $this->reset('deleteTransactionId');
            $this->showDeleteTransactionPopup = false;
            redirect()->route('dashboard')->with('success', 'Transaction deleted successfully');
            return;
        }
        redirect()->back()->with('error', 'Transaction not deleted');
    }

    public function render()
    {
        return view('livewire.layout.dashboard-items', [
            'transactions' => User::with('transaction')->find(Auth::id())->transaction()->with("category")->paginate(10)
        ]);
    }
}
