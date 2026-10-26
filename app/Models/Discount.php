<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'discount_percentage',
        'color',
        'benefits',
        'button_label',
        'button_link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'benefits' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('discount_percentage', 'desc');
    }
}
