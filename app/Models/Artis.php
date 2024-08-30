<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artis extends Model
{
    use HasFactory;

    protected $table = 'artiss';

    protected $fillable = [
        'artis',
    ];
}
