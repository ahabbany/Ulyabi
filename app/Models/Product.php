<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'subcategory_id', 'name', 'slug', 'description',
        'image', 'price', 'is_best_seller', 'is_new_arrival',
    ];

    protected function casts(): array
    {
        return [
            'is_best_seller' => 'boolean',
            'is_new_arrival' => 'boolean',
        ];
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function activeVariants()
    {
        return $this->hasMany(ProductVariant::class)->where('is_active', true);
    }

    public function getCategoryAttribute()
    {
        return $this->subcategory->category;
    }
}
