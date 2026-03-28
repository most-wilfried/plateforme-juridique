<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LawyerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bar_number',
        'phone',
        'experience_years',
        'bio',
        'city',
        'address',
        'hourly_rate',
        'currency',
        'specialties',
        'languages',
        'working_days',
        'work_start',
        'work_end',
    ];

    protected $casts = [
        'hourly_rate' => 'decimal:2',
        'specialties' => 'array',
        'languages' => 'array',
        'working_days' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCompleted($query)
    {
        return $query->whereNotNull('bar_number')
            ->whereNotNull('city')
            ->whereNotNull('hourly_rate')
            ->whereNotNull('currency')
            ->whereNotNull('experience_years');
    }

    public function isCompleted(): bool
    {
        return $this->bar_number
            && $this->city
            && $this->hourly_rate !== null
            && $this->currency
            && $this->experience_years !== null;
    }
}
