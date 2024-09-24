<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventartis extends Model
{
    use HasFactory;
    protected $fillable =[
        'event_id',
        'artis_id'
    ];

    public function event(){
        return $this->belongsTo(Event::class,'event_id'); // relasi dengan event dan sebagai yang mengambil data
    }
    public function artis(){
        return $this->belongsTo(Artis::class,'artis_id'); // relasi dengan artis dan sebagai yang mengambil data
    }
}
