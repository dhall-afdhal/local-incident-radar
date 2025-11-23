<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'summary',
        'category',
        'urgency_level',
        'latitude',
        'longitude',
        'image_path',
        'status',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return null;
    }

    public function getUrgencyColorAttribute()
    {
        return match($this->urgency_level) {
            'high' => 'danger',
            'medium' => 'warning',
            'low' => 'info',
            default => 'secondary',
        };
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'resolved' => 'success',
            'reviewed' => 'primary',
            'pending' => 'warning',
            default => 'secondary',
        };
    }
}


