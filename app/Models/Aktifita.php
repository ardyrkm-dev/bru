<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktifita extends Model
{
    use HasFactory;
    protected $table = 'aktifitas';
    protected $fillable = [
        'name',
        'deskripsi',
        'gambar',
        'durasi',
        'kalori',
    ];

    public function alternatives()
    {
        return $this->hasMany(Alternative::class, 'aktifitas_object_id');
    }
}
