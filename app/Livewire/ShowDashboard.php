<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class ShowDashboard extends Component
{



    public $pieChart;


    public function mount()
    {

        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();




        $this->pieChart = Transaction::with('category')
            ->where('user_id', '=', Auth::id())
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select('category_id', DB::raw('SUM(amount) as total_transactions'))
            ->groupBy('category_id')
            ->get()
            ->pluck('total_transactions', 'category.name')
            ->toArray();
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
                return Carbon::parse($date->created_at)->format('m');
            });


        $creditTransactions =  $debitTransactions = [];

        for ($i = 1; $i < 13; $i++) {
            $date = DateTime::createFromFormat('m', sprintf('%02d', $i))->format('F');
            $creditTransactions[$date] = 0;
            $debitTransactions[$date] = 0;
        }

        foreach ($transactions as $month => $trans) {
            $credit =   $trans->where('type', 'income')->sum('amount');
            $debit  =   $trans->where('type', 'expense')->sum('amount');
            $formattedMonth = DateTime::createFromFormat('m', sprintf('%02d', $month))->format('F');
            $creditTransactions[$formattedMonth] = $credit;
            $debitTransactions[$formattedMonth] = $debit;
        }


        return [
            'credit' => $creditTransactions,
            'debit' => $debitTransactions
        ];
    }

    private function getMonthlyTransactions($userID, $transactionType)
    {
        return User::with('transaction')->find($userID)->transaction()
            ->where('type', $transactionType)
            ->whereMonth('created_at', date('m'))
            ->sum('amount');
    }

    public function render()
    {

        $userId = Auth::id();

        if (!$userId) {
            return view('livewire.show-dashboard', [
                'monthCredit' => 0,
                'monthDebit' => 0,
                'monthBalance' => 0,
                'transactions' => [],
            ]);
        }

        $monthCredit = $this->getMonthlyTransactions($userId, 'income');
        $monthDebit = $this->getMonthlyTransactions($userId, 'expense');

        return view('livewire.show-dashboard', [
            'monthCredit' =>  number_format($monthCredit),
            'monthDebit' => number_format($monthDebit),
            'monthBalance' => number_format($monthCredit - $monthDebit),
            'transactions' => $this->getAnnualTransactions(),
        ]);
    }
}
