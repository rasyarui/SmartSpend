<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Carbon\Carbon;


class CardTransaction extends Component
{

    public $totalIncome;
    public $totalExpense;
    public $balance;

    public $startDate;
    public $endDate;


    public $showExpense = false;
    public $showIncome = false;
    public $showBalance = false;

    public $showAllVisibility = false;


    public $actualExpense;
    public $actualIncome;
    public $actualBalance;

    protected $listeners = ['moneyUpdated' => 'loadFinancialData', 'filterByDate' => 'applyDateFilter'];

    public function render()
    {
        
        $transactions = Transaction::with('category')
            ->forUser(Auth::id())
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.card-transaction', [
            'transactions' => $transactions,
        ]);
    }

    #[On('moneyUpdated')]
    public function mount()
    {
        sleep(2);
        $this->startDate = Carbon::now()->startOfMonth()->toDateString();
        $this->endDate = Carbon::now()->endOfMonth()->toDateString();
        $this->loadFinancialData();

        $this->actualExpense = $this->totalExpense;
        $this->actualIncome = $this->totalIncome;
        $this->actualBalance = $this->balance;
    }


    public function applyDateFilter($range = null)
    {
        if ($range) {
            // Logic for quick filters like 'yesterday', 'last30days', etc.
            switch ($range) {
                case 'yesterday':
                    $this->startDate = Carbon::yesterday()->toDateString();
                    $this->endDate = Carbon::yesterday()->toDateString();
                    break;
                case 'last30days':
                    $this->startDate = Carbon::now()->subDays(29)->toDateString();
                    $this->endDate = Carbon::now()->toDateString();
                    break;
                case 'lastYear':
                    $this->startDate = Carbon::now()->subYear()->toDateString();
                    $this->endDate = Carbon::now()->toDateString();
                    break;
                case 'thisMonth':
                default:
                    $this->startDate = Carbon::now()->startOfMonth()->toDateString();
                    $this->endDate = Carbon::now()->endOfMonth()->toDateString();
                    break;
            }
        }

        $this->loadFinancialData();
    }

    public function toggleVisibility($card)
    {
        switch ($card) {
            case 'expense':
                $this->showExpense = !$this->showExpense;
                break;
            case 'income':
                $this->showIncome = !$this->showIncome;
                break;
            case 'balance':
                $this->showBalance = !$this->showBalance;
                break;
        }
    }

    public function showAllVisibility()
    {
        $this->showBalance = !$this->showBalance;
        $this->showIncome = !$this->showIncome;
        $this->showExpense = !$this->showExpense;
    }



    public function loadFinancialData()
    {

        if (Auth::check()) {
            $userId = Auth::id();

            $query = Transaction::forUser($userId);
            // Apply date filter
            if ($this->startDate && $this->endDate) {
                $query->where('transaction_date', [$this->startDate, $this->endDate]);
            }

            $this->totalIncome = Transaction::forUser($userId)->income()->sum('amount');
            $this->totalExpense = Transaction::forUser($userId)->expense()->sum('amount');
            $this->balance = $this->totalIncome - $this->totalExpense;
        } else {
            $this->totalIncome = 0;
            $this->totalExpense = 0;
            $this->balance = 0;
        }
    }
}
