<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'key_highlights',
        'why_choose_features',
        'icon',
        'image',
        'price',
        'duration_minutes',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'key_highlights' => 'array',
        'why_choose_features' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function treatmentOptions()
    {
        return $this->hasMany(TreatmentOption::class)->orderBy('order', 'asc');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
