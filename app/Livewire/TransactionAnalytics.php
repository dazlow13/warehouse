<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Illuminate\Support\Collection;

class TransactionAnalytics extends Component
{
    public string $title;
    
    public function __construct()
    {
        $routeName = FacadesRoute::currentRouteName();
        $arr = explode(".", $routeName);
        $arr = array_map('ucfirst', $arr);
        $this->title = implode(' ', $arr);
        View::share('title', $this->title);
    }
    
    public $type = 'import';
    public $month;
    public $year;
    public Collection $tableData;
    public Collection $labels;
    public Collection $data;
    public $totalAmount = 0;
    public $totalTransactions = 0;

    public function mount()
    {
        $this->tableData = collect([]);
        $this->labels = collect([]);
        $this->data = collect([]);
        
        $this->month = date('m');
        $this->year = date('Y');
        $this->loadChartData();
    }

    public function updatedType()
    {
        $this->loadChartData();
    }
    
    public function updatedMonth()
    {
        $this->loadChartData();
    }
    
    public function updatedYear()
    {
        $this->loadChartData();
    }

    public function loadChartData()
    {
        // 1. LẤY DỮ LIỆU CHO BẢNG TRƯỚC
        $this->tableData = Transaction::where('type', $this->type)
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->orderBy('created_at', 'desc')
            ->get();

        // 2. TÍNH TỔNG SAU KHI ĐÃ CÓ DỮ LIỆU
        $this->totalAmount = $this->tableData->sum('total_amount');
        $this->totalTransactions = $this->tableData->count();

        // 3. LẤY DỮ LIỆU CHO CHART
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

        $this->labels = $chart->pluck('date');
        $this->data = $chart->pluck('total_amount');

        // Livewire v3 cách dispatch đúng
        $this->dispatch('refresh-chart', labels: $this->labels, data: $this->data);
    }

    public function render()
    {
        return view('livewire.transaction-analytics');
    }
}