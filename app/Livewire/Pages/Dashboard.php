<?php

namespace App\Livewire\Pages;

use Log;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Categories;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;



class Dashboard extends Component
{
    use WithPagination;
    
    public function render()
    {
        $transactionsQuery = Transaction::with('category')
            ->forUser(Auth::id())
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')->get();

        // Tambahkan filter kondisional


        return view('livewire.pages.dashboard', [
            'transactions' => $transactionsQuery,
            'stats' => $this->stats,
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
            'balance' => $balance
        ];
    }

     public function openModalIncome()
    {

        $this->dispatch('openModal', 'income');
    }
    public function openModalExpense()
    {

        $this->dispatch('openModal', 'expense');
    }

}
