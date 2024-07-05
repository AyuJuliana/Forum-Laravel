<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Forum extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'forum';

    protected $fillable = [
        'judul',
        'konten',
        'user_id',
        // tambahkan kolom lain yang ingin diizinkan untuk mass assignment di sini
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }
}
