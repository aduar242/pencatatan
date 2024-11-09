<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'payment_date', 'due_date', 'package_id'];

    protected static function boot()
    {
        parent::boot();

        // Atur default payment_date ke tanggal sekarang jika belum diisi
        static::creating(function ($client) {
            if (is_null($client->payment_date)) {
                $client->payment_date = Carbon::now();
            }
        });
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
