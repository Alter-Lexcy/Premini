<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attende extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'phone',
    ];

    
}
