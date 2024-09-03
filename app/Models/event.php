<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class event extends Model
{
    use HasFactory;
    protected $fillable = [
        'foto',
        'nama_event',
        'mulai',
        'berakhir',
        'sponsor_id',
        'artis_id',
        'venue_id',
        'categori_id',
        'stok',
    ];

    public function sponsor(){
        return $this->belongsTo(Sponsor::class);
    }
    public function artis(){
        return $this->belongsTo(Artis::class);
    }
    public function venue(){
        return $this->belongsTo(venue::class);
    }
    public function category(){
        return $this->belongsTo(Categori::class, 'categori_id');
    }
}
