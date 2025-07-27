<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable=[
        'ip_address',
        'user_agent',
        'url',
        'city',
        'province',
    ];

    public function getTimeToLiveAttribute(): string
    {
        return $this->created_at
            ? $this->created_at->translatedFormat('d F Y H:i:s')
            : '';
    }
}
