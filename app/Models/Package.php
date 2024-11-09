<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description'];

    // Relasi ke Client
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
