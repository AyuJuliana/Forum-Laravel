<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function forum(){
        return $this->hasMany(Forum::class);
    }

    public function komentar(){
        return $this->hasMany(Komentar::class);
    }

    public function pengguna(){
        return $this->hasOne(Pengguna::class);
    }
}
