<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'price', 'image', 'category_id', 'stock', 'active'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
        static::updating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }
}
