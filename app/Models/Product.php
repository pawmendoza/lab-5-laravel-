<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'description',
        'category_id',
        'brand_id',
        'quantity',
        'reorder_level',
        'unit_price',
        'cost_price',
        'supplier',
    ];

    


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    


    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }

    


    public function scopeLowStock($query)
    {
        return $query->whereColumn('quantity', '<=', 'reorder_level')
                     ->where('quantity', '>', 0);
    }

    


    public function scopeOutOfStock($query)
    {
        return $query->where('quantity', '<=', 0);
    }
}