<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialty_ids',
        'location',
        'hourly_rate',
        'bio',
        'photo',
    ];

    protected $casts = [
        'hourly_rate' => 'decimal:2',
        'specialty_ids' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }
}

