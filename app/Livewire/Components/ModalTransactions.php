<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Categories;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class ModalTransactions extends Component
{
    public $showModal = false;
    public $showCategoryModal = false;
    public $showCategoryDropdown = false;


    public $description = '';
    public $amount = '';
    public $transaction_date = '';

    public $category_id = '';
    public $category = '';

    public $categorySearch = '';

    public $transactionType = 'income';
    protected $listeners = ['openModal'];


    public function render()
    {
        return view('livewire.components.modal-transactions', [
            'categories' => $this->categories
        ]);
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
