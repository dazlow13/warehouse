<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;


class Transaction extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'quantity',
        'user_id',
        'type',
        'note',
        'total_amount'
    ];

    public function details(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($transaction) {
            if (empty($transaction->code)) {
                $transaction->code = self::generateUniqueCode($transaction->type);
            }
        });
    }

    public static function generateUniqueCode($type)
    {
        return DB::transaction(function () use ($type) {
            $prefix = $type === 'import' ? 'NH' : 'XK';

            // LẤY MÃ LỚN NHẤT + KHÓA DÒNG
            $last = self::where('code', 'like', $prefix . '%')
                ->lockForUpdate()
                ->max('code');

            if ($last) {
                $number = (int) substr($last, 2) + 1;
            } else {
                $number = 1;
            }

            return $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
        });
    }
}