<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Manufacturer extends Model
{
    /** @use HasFactory<\Database\Factories\ManufacturerFactory> */
    use HasFactory;
    protected $fillable = 
    ['name', 'email', 'phone', 'address', 'description'];
    public $timestamps = true;
    public function products()
    {
        return $this->hasMany(Product::class, 'manufacturer_id');
    }
}
