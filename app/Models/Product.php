<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Manufacturer;
class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'name',
        'category_id',//danh mục
        'manufacturer_id',//nhà sản xuất
        'quantity',
        'unit',//đơn vị tính
        'cost_price',
        'sale_price',
        'description',
        'image',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
