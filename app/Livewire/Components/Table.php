<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Categories;
use App\Models\Transaction;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;



class Table extends Component
{
    use WithPagination;
    public $showModalDelete = false;
    public $filter_types = [];
    public $filter_category = [];
    public $hiddenColumns = [];
    public $deleteTransactionId = null;
    public $sortField = 'transaction_date'; // Default field untuk pengurutan
    public $sortDirection = 'desc'; // Default direction



    #[On('moneyUpdated')]
    public function render()
    {
        $transactionsQuery = Transaction::with('category')
            ->forUser(Auth::id())
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc');

        // Tambahkan filter kondisional
        if (!empty($this->filter_types)) {
            $transactionsQuery->whereIn('type', $this->filter_types);
        }

        if (!empty($this->filter_category)) {
            $transactionsQuery->whereHas('category', function ($query) {
                $query->whereIn('category', $this->filter_category);
            });
        }
        $transactions = $transactionsQuery->paginate(5);

        return view('livewire.components.table', [
            'transactions' => $transactions,
            'categories' => $this->categories
        ]);
    }

    public function mount(){
        
    }

    public function getCategoriesProperty()
    {
        $data =  Categories::active()
            ->forUser(Auth::id())
            ->orderBy('category');


        return $data->get();
    }


    public function toggleColumn($column)
    {
        if (in_array($column, $this->hiddenColumns)) {
            // Jika kolom sudah tersembunyi, hapus dari array untuk menampilkannya
            $this->hiddenColumns = array_diff($this->hiddenColumns, [$column]);
        } else {
            // Jika belum tersembunyi, tambahkan ke array
            $this->hiddenColumns[] = $column;
        }
    }

    public function clearFilter()
    {
        $this->filter_types = [];
        $this->filter_category = [];
        // Tidak perlu memanggil render() secara manual, Livewire otomatis merender ulang
    }
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function openModalDelete($id)
    {
        $transaction = Transaction::where('user_id', Auth::id())->find($id);

        if (!$transaction) {
            session()->flash('error', 'Transaksi tidak ditemukan.');
            return;
        }
        $this->deleteTransactionId = $id;

        $this->showModalDelete = true;
    }
    public function closeModalDelete()
    {
        $this->showModalDelete = false;
    }


    public function deleteTransaction()
    {
        $id = $this->deleteTransactionId;
        $this->deleteTransactionId = null;
        $transaction = Transaction::with('category')->where('user_id', Auth::id())->find($id);
        if ($transaction) {
            $transaction->delete();
            sleep(5);
            session()->flash('successD', 'Transaksi berhasil dihapus.');
            $this->closeModalDelete();

            $this->dispatch('moneyUpdated');
            // Opsional: refresh komponen lain
        } else {
            session()->flash('error', 'Transaksi tidak ditemukan.');
        }
    }
}
