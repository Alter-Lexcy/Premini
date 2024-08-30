<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categori extends Model
{
    use HasFactory;

    protected $table = 'categoris';

    protected $fillable = [
        'categori', // Sesuaikan dengan nama kolom yang ada di tabel `categoris`
    ];
}
