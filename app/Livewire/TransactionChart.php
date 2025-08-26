<?php

namespace App\Livewire;

use DateTime;
use DatePeriod;
use DateInterval;
use Livewire\Component;
use App\Models\Transaction;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class TransactionChart extends Component
{
    public $date_time = [];
    public $income_data = [];
    public $expense_data = [];

    protected $listeners = ['moneyUpdated' => 'loadFinancialData'];

    public function render()
    {
        return view('livewire.transaction-chart', [
            'stats' => $this->stats
        ]);
    }
    public function getStatsProperty()
    {
        $userId = Auth::id();

        $totalIncome = Transaction::forUser($userId)->income()->sum('amount');
        $totalExpense = Transaction::forUser($userId)->expense()->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return [
            'total_income' => $totalIncome,
            'total_expense' => $totalExpense,
            'balance' => $balance,
            'netChange' => $balance > 0 ? 'positive' : 'negative'

        ];
    }


    #[On('moneyUpdated')]
    public function mount()
    {
        $now = now();
        $date_from = $now->copy()->startOfMonth(); // 7 hari termasuk hari ini

        $start = new DateTime($date_from);
        $end = new DateTime($now);

        $end->modify('+1 day');

        $interval = new DateInterval('P1D');
        $period = new DatePeriod($start, $interval, $end);

        $this->date_time = [];
        $this->income_data = [];
        $this->expense_data = [];

        foreach ($period as $dt) {
            $dateStr = $dt->format('Y-m-d');
            $this->date_time[] = $dateStr;

            $dailyIncome = Transaction::with('category')
                ->where('type', 'income')
                ->forUser(Auth::id())
                ->where('transaction_date', $dateStr)
                ->sum('amount');


            $dailyExpense = Transaction::with('category')
                ->where('type', 'expense')
                ->forUser(Auth::id())
                ->where('transaction_date', $dateStr)
                ->sum('amount');

            $netTotal = $dailyIncome - $dailyExpense;



            $this->income_data[] = (int) $dailyIncome;
            $this->expense_data[] = (int) $dailyExpense;
        }
    }

    
}
