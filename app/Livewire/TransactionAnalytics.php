<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use App\Services\TransactionStatisticService;
use Illuminate\Support\Facades\DB;
use Pest\Support\Arr;

class TransactionAnalytics extends Component
{
    public $type = 'import';
    public $month;
    public $year;

    public $tableData;
    public array $labels = [];
    public array $data = [];

    public $totalAmount = 0;
    public $totalTransactions = 0;

    protected TransactionStatisticService $service;
    public function mount(TransactionStatisticService $service)
    {
        $this->service = $service;
        $this->month = date('m');
        $this->year = date('Y');
        $this->loadChartData();
    }

    public function updated($field)
    {
        $this->loadChartData();
    }

    public function loadChartData()
{
    // TABLE
    $this->tableData = Transaction::where('type', $this->type)
        ->whereMonth('created_at', $this->month)
        ->whereYear('created_at', $this->year)
        ->orderBy('created_at','desc')
        ->get(); // giữ nguyên Collection

    $this->totalAmount = $this->tableData->sum('total_amount');
    $this->totalTransactions = $this->tableData->count();

    // CHART
    $chart = Transaction::where('type', $this->type)
        ->whereMonth('created_at', $this->month)
        ->whereYear('created_at', $this->year)
        ->select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_amount) as total_amount')
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $this->labels = $chart->pluck('date')->toArray();
    $this->data = $chart->pluck('total_amount')->toArray();

    $this->dispatch('refresh-chart', labels: $this->labels, data: $this->data);
}

    public function render()
    {
        return view('livewire.transaction-analytics');
    }
}
