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
    public $showModal = false;
    public $showModalDelete = false;
    public $showCategoryModal = false;
    public $showCategoryDropdown = false;

    public $deleteTransactionId = null;

    public $transactionType = 'income';

    // Form field
    public $description = '';
    public $amount = '';
    public $transaction_date = '';

    public $category_id = '';
    public $category = '';
    public $categoryName = '';
    public $categorySearch = '';

    public $transaction_type = null;

    public $filter_types = [];
    public $filter_category = [];

    public $sortField = 'transaction_date'; // Default field untuk pengurutan
    public $sortDirection = 'desc'; // Default direction
    public $hiddenColumns = [];



    public function deleteTransaction()
    {
        $id = $this->deleteTransactionId;
        $this->deleteTransactionId = null;
        $transaction = Transaction::with('category')->where('user_id', Auth::id())->find($id);
        if ($transaction) {
            $transaction->delete();
            sleep(5);
            session()->flash('successD', 'Transaksi berhasil dihapus.');
            $this->dispatch('moneyUpdated');
            $this->showModalDelete = false;
            // Opsional: refresh komponen lain
        } else {
            session()->flash('error', 'Transaksi tidak ditemukan.');
        }
    }

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

        return view('livewire.pages.dashboard', [
            'transactions' => $transactions,
            'stats' => $this->stats,
            'categories' => $this->categories
        ]);
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
    protected $rules = [
        'description' => 'nullable|string',
        'amount' => 'required|numeric|min:0',
        'transaction_date' => 'required|date_format:Y-m-d',
        'category_id' => 'required|exists:categories,id',
        'category' => 'nullable|string|max:255'
    ];

    protected $messages = [
        'amount.required' => 'Jumlah harus diisi',
        'amount.numeric' => 'Jumlah harus berupa angka',
        'amount.min' => 'Jumlah tidak boleh negatif',
        'transaction_date.required' => 'Tanggal transaksi harus diisi',
        'transaction_date.date' => 'Format tanggal tidak valid',
        'category_id.exists' => 'Kategori yang dipilih tidak valid',
        'category_id.required' => 'Pilih kategori dahulu',
        'category.required' => 'Nama kategori harus diisi',
        'category.max' => 'Nama kategori maksimal 255 karakter'
    ];

    public function resetForm()
    {
        $this->description = '';
        $this->amount = '';
        $this->transaction_date = now()->format('Y-m-d');
        $this->category_id = '';
        $this->category = "";
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

    public function openModal($type)
    {
        $this->transactionType = $type;
        $this->showModal = true;
        $this->resetForm();
    }

    public function closeModal()
    {
        $this->showCategoryDropdown = false;
        $this->showModal = false;
        $this->showCategoryModal = false;
        $this->resetForm();
        $this->resetValidation();
    }

    public function openCategoryDropdown()
    {
        $this->showCategoryDropdown = true;
        $this->resetErrorBag(['category']);
    }

    public function closeCategoryDropdown()
    {
        $this->showCategoryDropdown = false;
        $this->resetForm();
        $this->resetErrorBag(['category']);
    }

    public function openCategoryModal()
    {
        $this->category = '';
        $this->showCategoryModal = true;
        $this->resetErrorBag(['category']);
    }

    // Method untuk menutup modal kategori
    public function closeCategoryModal()
    {
        $this->showCategoryModal = false;
        $this->category_id = '';
        $this->category = '';
        $this->categorySearch = '';
        $this->resetValidation();
        $this->resetErrorBag(['category']);
    }

    public function saveNewCategory()
    {

        $this->validate([
            'category' => 'required|string|max:255'
        ]);

        $exists = Categories::where('user_id', Auth::id())
            ->where('category', $this->category)
            ->where('type', $this->transactionType)
            ->exists();

        if ($exists) {
            $this->addError('category', 'Nama kategori sudah ada untuk tipe ini.');
            return;
        }

        $newCategory = Categories::create([
            'user_id' => Auth::id(),
            'category' => $this->category,
            'type' => $this->transactionType,
            'is_active' => true
        ]);

        // Set kategori yang baru dibuat sebagai yang terpilih
        $this->category_id = $newCategory->id;

        $this->closeCategoryModal();

        session()->flash('category', 'Kategori baru berhasil ditambahkan dan dipilih!');
    }



    public function getCategoriesProperty()
    {
        $data =  Categories::active()
            ->forUser(Auth::id())
            ->forType($this->transactionType)
            ->orderBy('category');

        if (!empty($this->categorySearch)) {
            $data->where('category', 'like', '%' . $this->categorySearch . '%');
        }

        return $data->get();
    }


    // Tambahkan method ini ke class Dashboard Livewire Anda
    public function selectCategory($categoryId, $categoryName)
    {
        $this->category_id = $categoryId;
        $this->category = $categoryName;
        $this->categorySearch = '';
    }

    public function saveTransaction()
    {
        // sleep(5);

        $this->validate();


        Transaction::create([
            'user_id' => Auth::id(), // Menambahkan user_id
            'description' => $this->description,
            'amount' => $this->amount,
            'type' => $this->transactionType,
            'transaction_date' => $this->transaction_date,
            'category_id' => $this->category_id
        ]);

        $this->dispatch('moneyUpdated');


        $this->closeModal();

        // $this->closeModal();

        // session()->flash('message', 
        //     $this->transactionType === 'income' ? 
        //     'Penghasilan berhasil ditambahkan!' : 
        //     'Pengeluaran berhasil ditambahkan!'
        // );
    }
}
