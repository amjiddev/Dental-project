<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialization',
        'qualification',
        'bio',
        'image',
        'email',
        'phone',
        'experience_years',
        'is_active',
        'is_lead_doctor',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_lead_doctor' => 'boolean',
        'experience_years' => 'integer',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
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
