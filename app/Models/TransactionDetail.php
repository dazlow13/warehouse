<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDetail extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'transaction_id',
        'product_id',
        'manufacturer_id',
        'quantity',
        'unit_price'
    ];

    protected static function booted()
    {
        static::saving(fn($d) => $d->total = $d->quantity * $d->unit_price);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function getProductNameAttribute()
    {
        return $this->product?->name ?? 'Sản phẩm bị xóa';
    }
}