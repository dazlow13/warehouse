<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class TransactionAnalytics extends Component
{
    public $type = 'import';
    public $labels = [];
    public $data = [];

    public function mount()
    {
        $this->loadChartData();
    }

    public function updatedType()
    {
        $this->loadChartData();
    }

   public function loadChartData()
{
    $result = Transaction::select(
        DB::raw('DATE(created_at) as date'),
        DB::raw('SUM(total_amount) as total_amount')
    )
    ->where('type', $this->type)
    ->groupBy('date')
    ->orderBy('date')
    ->get();

    $this->labels = $result->pluck('date');
    $this->data = $result->pluck('total_amount');

    // Livewire v3 cách dispatch đúng
    $this->dispatch('refresh-chart', labels: $this->labels, data: $this->data);
}

    public function render()
    {
        return view('livewire.transaction-analytics');
    }
}
