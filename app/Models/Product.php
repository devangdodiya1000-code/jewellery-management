<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'type_id',
        'price',
        'discount',
        'metal_type',
        'weight',
        'status',
        'qty',
        'images',
        'is_add_to_list',
    ];

    protected $casts = [
        'is_add_to_list' => 'boolean',
    ];

    public function type() {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
