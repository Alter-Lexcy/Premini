<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'jam_acara',
        'deskripsi_acara',
    ];

    public function event(){
        /// format untuk relasi one to many
        return $this->belongsTo(event::class);
    }
}
