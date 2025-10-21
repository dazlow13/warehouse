<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, Sluggable;
    public $timestamps = true; 
    protected $fillable = ['name', 'slug','image'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
