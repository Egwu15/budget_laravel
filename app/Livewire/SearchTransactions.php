<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Component;

class SearchTransactions extends Component
{

    public $search = '';
    public $descriptions = [];

    public function updateSearch($searchItem)
    {
        $searchItem = trim($searchItem);
        
        if (strlen($searchItem) == 0) {
            $this->descriptions = [];
            return;
        }

        $this->descriptions =  Transaction::select('description')
            ->where('user_id', auth()->id())
            ->where('description', 'like', "%{$searchItem}%")
            ->distinct()
            ->limit(6)
            ->get();
    }

    public function render()
    {

        return view('livewire.search-transactions');
    }
}
