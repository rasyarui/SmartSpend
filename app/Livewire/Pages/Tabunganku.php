<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Tabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Tabunganku extends Component
{
    public $showModal = false;

    public $showModalDeposit = false;
    public $showModalDelete = false;
    public $selectedGoalId = null;

    public $amount = '';


    public $name, $description, $target_amount, $deadline, $category, $priority;
    protected $listeners = ['refreshGoals' => '$refresh'];

    public function render()
    {

        $goals = Tabungan::where('user_id', Auth::id())
            ->orderByRaw("FIELD(priority, 'low', 'medium', 'hard')")->get();

        $goal = $this->selectedGoalId
            ? Tabungan::find($this->selectedGoalId)
            : null;

        $isProgressCount = $goals->where('isCompleted', false)->count();
        $completedCount = $goals->where('isCompleted', true)->count();

        return view('livewire.pages.tabunganku', compact('goals', 'isProgressCount', 'completedCount'), [
            'stats' => $this->stats,
            'selectedGoal' => $goal
        ]);
    }

    public function getStatsProperty()
    {
        return [
            'total_data' => Tabungan::where('user_id', Auth::id())->count(),
            'total_target' => Tabungan::where('user_id', Auth::id())->sum('target_amount'),
            'total_current' => Tabungan::where('user_id', Auth::id())->sum('current_amount'),
        ];
    }

    public function openModal()
    {
        $this->deadline = now()->format('Y-m-d');
        $this->showModal = true;
    }
    public function openModalDeposit($goalId)
    {
        $this->selectedGoalId = $goalId;
        $this->deadline = now()->format('Y-m-d');
        $this->showModalDeposit = true;
    }
    public function openModalDelete($goalId)
    {
        $this->selectedGoalId = $goalId;
        $this->deadline = now()->format('Y-m-d');
        $this->showModalDelete = true;
    }
    public function closeModal()
    {
        $this->showModal = false;
        $this->showModalDelete = false;
        $this->showModalDeposit = false;
        $this->reset(['selectedGoalId', 'amount']);
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'target_amount' => 'required|numeric|min:0',
        'deadline' => 'required|date_format:Y-m-d',
        'category' => 'nullable|string|max:255',
    ];

    protected $messages = [
        'name.required' => 'Nama goal harus diisi',
        'target_amount.required' => 'Jumlah harus diisi',
        'target_amount.numeric' => 'Jumlah harus berupa angka',
        'target_amount.min' => 'Jumlah tidak boleh negatif',
        'deadline.required' => 'Tanggal transaksi harus diisi',
        'deadline.date' => 'Format tanggal tidak valid',
        'category_id.required' => 'Pilih kategori dahulu',
    ];

    public function createTabungan()
    {

        $this->validate();


        Tabungan::create([
            'user_id' => Auth::id(), // Menambahkan user_id
            'name' => $this->name,
            'target_amount' => $this->target_amount,
            'category' => $this->category,
            'priority' => $this->priority,
            'description' => $this->description,
            'deadline' => $this->deadline,
        ]);

        $this->dispatch('moneyUpdated');
        $this->closeModal();
    }

    public function deposit()
    {
        $this->validate([
            'amount' => 'required|integer|min:1'
        ]);

        $goal = Tabungan::where('id', $this->selectedGoalId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($goal->isCompleted) {
            $this->dispatch('error', message: "🎯 '{$goal->name}' sudah selesai.");
            return;
        }

        $goal->current_amount += $this->amount;
        $goal->save();

        $this->dispatch('depositSuccess', name: $goal->name, amount: $this->amount);
        $this->closeModal();
        $this->dispatch('refreshGoals');
    }

    public function deleteTransaction()
    {

        $goal = Tabungan::where('id', $this->selectedGoalId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($goal) {
            $goal->delete();
            sleep(5);
            session()->flash('successD', 'Transaksi berhasil dihapus.');
            $this->closeModal();

            $this->dispatch('moneyUpdated');
            // Opsional: refresh komponen lain
        } else {
            session()->flash('error', 'Transaksi tidak ditemukan.');
        }
    }
}
