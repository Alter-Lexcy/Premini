<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Categori extends Model
    {
        use HasFactory;

        protected $table = 'categoris';
    
        protected $fillable = [
            'categori', // Pastikan nama ini sesuai dengan kolom di tabel `categoris`
        ];
    }
