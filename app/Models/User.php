<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Appointment;
use App\Models\Document;
use App\Models\LawyerProfile;
use App\Models\Message;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'is_approved',
        'approved_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_approved' => 'boolean',
        'approved_at' => 'datetime',
    ];

    public function lawyerProfile()
    {
        return $this->hasOne(LawyerProfile::class);
    }

    public function appointmentsAsClient()
    {
        return $this->hasMany(Appointment::class, 'client_id');
    }

    public function appointmentsAsLawyer()
    {
        return $this->hasMany(Appointment::class, 'lawyer_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function getUnreadMessagesCountAttribute()
    {
        return $this->receivedMessages()->where('is_read', false)->count();
    }

    public function hasCompletedLawyerProfile(): bool
    {
        return $this->role === 'avocat' && $this->lawyerProfile?->isCompleted();
    }

    public function isApproved(): bool
    {
        return $this->role !== 'avocat' || $this->is_approved;
    }

    public function isApprovalPending(): bool
    {
        return $this->role === 'avocat' && !$this->is_approved;
    }
}
