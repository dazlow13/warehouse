<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        Transaction::factory(10)
            ->create([
                'user_id' => User::factory(), // Tạo user mới cho mỗi phiếu
            ])
            ->each(function ($transaction) {
                $details = TransactionDetail::factory(rand(1, 3))->create([
                    'transaction_id' => $transaction->id,
                ]);
                $transaction->update([
                    'quantity' => $details->sum('quantity'),
                    'total_amount' => $details->sum(fn($d) => $d->quantity * $d->unit_price),
                ]);
            });
    }

}