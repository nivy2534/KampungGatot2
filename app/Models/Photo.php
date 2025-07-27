<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_name',
        'photo_description',
        'photo_date',
        'event_id',
        'production_id',
        'blog_id',
        'kategori',
        'status',         // published, draft, archived
        'author_id',      // user who uploaded the photo
    ];

    protected $casts = [
        'photo_date' => 'datetime',
    ];

    // Accessor untuk menampilkan tanggal dalam format yang lebih manusiawi jika dibutuhkan
    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->photo_date)->translatedFormat('d F Y');
    }

    // Relasi ke User (author)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Opsional: relasi ke event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Opsional: relasi ke blog
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    // Opsional: relasi ke production
    public function production()
    {
        return $this->belongsTo(Production::class);
    }
}
