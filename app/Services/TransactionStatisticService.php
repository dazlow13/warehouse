<?php
namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionStatisticService
{
    public function getTableData(string $type, int $month, int $year)
    {
        return Transaction::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as total_amount')
            )
            ->where('type', $type)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get();
    }

    public function getChartData(string $type, int $month, int $year)
    {
        return Transaction::select(
                DB::raw('DAY(created_at) as day'),
                DB::raw('SUM(total_amount) as total_amount')
            )
            ->where('type', $type)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('DAY(created_at)'))
            ->orderBy('day', 'asc')
            ->get();
    }
}


