<?php

namespace App\Models;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'user_id',
        'file_path',
        'file_name',
        'mime_type',
        'size',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCategoryAttribute(): string
    {
        return match (strtolower(pathinfo($this->file_name, PATHINFO_EXTENSION))) {
            'pdf' => 'PDF',
            'doc', 'docx' => 'Word',
            'jpg', 'jpeg', 'png', 'gif' => 'Image',
            default => 'Autre',
        };
    }
}

