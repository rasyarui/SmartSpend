<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Categories;
use App\Models\Transaction;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// <-- add import


class Transaksi extends Component
{
    public $transactionType = 'null';

    public $topCategoryIncome = null;
    public $topAmount = 0;
    // protected $listeners = ['openModal'];
    // public $modalOpen = false;
    public $jumlahData;
    public function render()
    {
        return view('livewire.pages.transaksi', [
            'stats' => $this->stats,
        ]);
    }

    public function openModalIncome()
    {

        $this->dispatch('openModal', 'income');
    }
    public function openModalExpense()
    {

        $this->dispatch('openModal', 'expense');
    }

    #[On('moneyUpdated')]
    public function mount()
    {
        $transactionsQuery = Transaction::with('category')
            ->forUser(Auth::id())
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')->get();

        $this->jumlahData = $transactionsQuery->count();
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
            'balance' => $balance
        ];
    }

    public function getPresentaseProperty()
    {
        $userId = Auth::id();

        $totalIncome = Transaction::forUser($userId)->income()->sum('amount');
        $totalExpense = Transaction::forUser($userId)->expense()->sum('amount');

        if ($totalIncome == 0) {
            if ($totalExpense == 0) {
                return 0;
            } else {
                return 100;
            }
        }

        $presentase = ($totalExpense / $totalIncome) * 100;

        return $presentase;
    }

    public function getRatioStatusProperty()
    {
        $ratio = $this->presentase;

        if ($ratio == 0) {
            return ['type' => 'excellent', 'icon' => '✅', 'message' => 'Bagus! kurangi pengeluaran kamu.', 'color' => 'green', 'bg' => 'bg-gradient-to-r from-emerald-500/10 to-blue-500/10'];
        } elseif ($ratio < 20) {
            return ['type' => 'positive', 'icon' => '✅', 'message' => 'Wow!! kamu sangat hemat', 'color' => 'green', 'bg' => 'bg-gradient-to-r from-emerald-500/10 to-blue-500/10'];
        } elseif ($ratio < 50) {
            return ['type' => 'good', 'icon' => '💡', 'message' => 'Bagus, terkendali!', 'color' => 'green', 'bg' => 'bg-gradient-to-r from-emerald-500/10 to-blue-500/10'];
        } elseif ($ratio < 70) {
            return ['type' => 'caution', 'icon' => '⚠', 'message' => 'Keuangan kamu perlu dikontrol', 'color' => 'yellow', 'bg' => 'bg-gradient-to-r from-amber-400/10 to-yellow-500/10'];
        } elseif ($ratio < 100) {
            return ['type' => 'warning', 'icon' => '🚨', 'message' => 'Segera kurangi belanja yang tidak penting.', 'color' => 'orange', 'bg' => 'bg-gradient-to-r from-amber-400/10 to-orange-500/10'];
        } else {
            return ['type' => 'critical', 'icon' => '❗️', 'message' => 'Saldo kamu minus. Pengeluaran melebihi pendapatan!', 'color' => 'red', 'bg' => 'bg-gradient-to-r from-red-500/10 to-purple-600/10'];
        }
    }

    private function getMonthlyTotal($type, $month, $year)
    {
        $userId = Auth::id();


        return Transaction::forUser($userId)
            ->where('type', $type)
            ->whereYear('transaction_date', $year)
            ->whereMonth('transaction_date', $month)
            ->sum('amount');
    }

    public function getIncomeStatsProperty()
    {
        $now = now();
        $currentMonth = $now->month;
        $currentYear = $now->year;

        $lastMonth = $now->subMonth();
        $lastMonthNum = $lastMonth->month;
        $lastYear = $lastMonth->year;

        $currentIncome = $this->getMonthlyTotal('income', $currentMonth, $currentYear);
        $lastIncome = $this->getMonthlyTotal('income', $lastMonthNum, $lastYear);

        $percentageChange = $lastIncome > 0
            ? (($currentIncome - $lastIncome) / $lastIncome) * 100
            : ($currentIncome > 0 ? 100 : 0);

        $trend = $percentageChange >= 0 ? 'up' : 'down';
        $icon = $trend === 'up' ? '' : '';
        $color = $trend === 'up' ? 'text-green-600' : 'text-red-600';

        return [
            'total' => $currentIncome,
            'change' => round($percentageChange, 1),
            'trend' => $trend,
            'icon' => $icon,
            'color' => $color,
            'label' => $trend === 'up' ? 'naik' : 'turun'
        ];
    }

    public function getExpenseStatsProperty()
    {
        $now = now();
        $currentMonth = $now->month;
        $currentYear = $now->year;

        $lastMonth = $now->subMonth();
        $lastMonthNum = $lastMonth->month;
        $lastYear = $lastMonth->year;

        $currentExpense = $this->getMonthlyTotal('expense', $currentMonth, $currentYear);
        $lastExpense = $this->getMonthlyTotal('expense', $lastMonthNum, $lastYear);

        $percentageChange = $lastExpense > 0
            ? (($currentExpense - $lastExpense) / $lastExpense) * 100
            : ($currentExpense > 0 ? 100 : 0);


        $trend = $percentageChange >= 0 ? 'up' : 'down';
        $icon = $trend === 'up' ? '' : '';
        $color = $trend === 'up' ? 'text-red-600' : 'text-green-600'; // ↑ pengeluaran = buruk


        return [
            'total' => $currentExpense,
            'change' => round($percentageChange, 1),
            'trend' => $trend,
            'icon' => $icon,
            'color' => $color,
            'label' => $trend === 'up' ? 'naik' : 'turun'
        ];
    }

    public function getBalanceStatsProperty()
    {
        $now = now();
        $currentMonth = $now->month;
        $currentYear = $now->year;

        $lastMonth = $now->subMonth();
        $lastMonthNum = $lastMonth->month;
        $lastYear = $lastMonth->year;

        $currentExpense = $this->getMonthlyTotal('expense', $currentMonth, $currentYear);
        $currentIncome = $this->getMonthlyTotal('income', $currentMonth, $currentYear);
        $currentBalance = $currentIncome - $currentExpense;

        $lastExpense = $this->getMonthlyTotal('expense', $lastMonthNum, $lastYear);
        $lastIncome = $this->getMonthlyTotal('income', $lastMonthNum, $lastYear);
        $lastBalance = $lastIncome - $lastExpense;


        if ($lastBalance == 0) {
            $change = $currentBalance > 0 ? 100 : ($currentBalance < 0 ? -100 : 0);
        } else {
            $change = (($currentBalance - $lastBalance) / abs($lastBalance)) * 100;
        }

        $change = round($change);
        $trend = $change >= 0 ? 'up' : 'down';
        $color = $trend === 'up' ? 'text-green-600' : 'text-red-600';

        return [
            'total' => $currentBalance,
            'change' => abs($change),
            'trend' => $trend,
            'color' => $color,
            'label' => $trend === 'up' ? 'naik' : 'turun'
        ];
    }

    public function getSavingsRateProperty()
    {
        $userId = Auth::id();

        $transactions = Transaction::forUser($userId)->get();

        if ($transactions->isEmpty()) {
            return [
                'start_date' => now()->format('d M Y'),
                'days_active' => 0,
                'daily_income' => 0,
                'daily_expense' => 0,
                'savings_rate' => 0,
                'is_in_debt' => false,
                'total_income' => 0,
                'total_expense' => 0,
                'current_balance' => 0,
            ];
        }

        $firstTransactionDate = $transactions->min('transaction_date');
        $startDate = Carbon::parse($firstTransactionDate)->startOfDay();

        $daysActive = $startDate->startOfDay()->diffInDays(now()->startOfDay()) + 1; // +1 karena inklusif

        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $currentBalance = $totalIncome - $totalExpense;

        $dailyIncome = $totalIncome / $daysActive;
        $dailyExpense = $totalExpense / $daysActive;

        $savingsRate = $totalIncome > 0 ? ($currentBalance / $totalIncome) * 100 : 0;
        $savingsRate = round($savingsRate, 1);

        return [
            'start_date' => $startDate->format('d M Y'),
            'days_active' => $daysActive,
            'daily_income' => round($dailyIncome, 0),
            'daily_expense' => round($dailyExpense, 0),
            'savings_rate' => $savingsRate,
            'is_in_debt' => $currentBalance < 0,
        ];
    }

    public function getTopCategoryProperty()
    {
        $userId = Auth::id();

        $topCategoryName = Transaction::where('transactions.user_id', $userId)
            ->where('transactions.type', 'income')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->groupBy('categories.id', 'categories.category')
            ->orderByDesc(DB::raw('SUM(transactions.amount)'))
            ->value('categories.category');
        return [
            'top_category' => $topCategoryName
        ];
    }
}
