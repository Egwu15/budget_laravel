<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;

class ShowDashboard extends Component
{


    public function mount()
    {
    }

    public function getAnnualTransactions()
    {


        $userId = Auth::id();
        $user = User::find($userId);
        if (!$user) {
            return ['credit' => [], 'debit' => []];
        }

        $transactions = $user->transaction()
            ->whereBetween("created_at", [now()->subYear(), now()->endOfYear()])
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m'); // Group by month
            });


        $creditTransactions = [];
        $debitTransactions = [];
        for ($i = 1; $i < 13; $i++) {
            $date = DateTime::createFromFormat('m', sprintf('%02d', $i))->format('F');
            $creditTransactions[$date] = 0;
            $debitTransactions[$date] = 0;
        }

        foreach ($transactions as $month => $trans) {
            $credit = $trans->where('type', 'income')->sum('amount');
            $debit = $trans->where('type', 'expense')->sum('amount');
            $formattedMonth = DateTime::createFromFormat('m', sprintf('%02d', $month))->format('F');
            $creditTransactions[$formattedMonth] = $credit;
            $debitTransactions[$formattedMonth] = $debit;
        }


        return [
            'credit' => $creditTransactions,
            'debit' => $debitTransactions
        ];
    }

    public function render()
    {
        $monthCredit = User::with('transaction')->find(Auth::id())->transaction()->where('type', 'income')->whereMonth('created_at', date('m'))->sum('amount');
        $monthDebit = User::with('transaction')->find(Auth::id())->transaction()->where('type', 'expense')->whereMonth('created_at', date('m'))->sum('amount');

        return view('livewire.show-dashboard', [
            'monthCredit' => $monthCredit,
            'monthDebit' => $monthDebit,
            'monthBalance' => $monthCredit - $monthDebit,
            'transactions' => $this->getAnnualTransactions(),
        ]);
    }
}
