<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ShowDashboard extends Component
{
    public function render()
    {


        $monthCredit = User::with('transaction')->find(Auth::id())->transaction()->where('type', 'income')->whereMonth('created_at', date('m'))->sum('amount');
        $monthDebit = User::with('transaction')->find(Auth::id())->transaction()->where('type', 'expense')->whereMonth('created_at', date('m'))->sum('amount');

        return view('livewire.show-dashboard', [
            'monthCredit' => $monthCredit,
            'monthDebit' => $monthDebit,
            'monthBalance' => $monthCredit - $monthDebit,
        ]);
    }
}
