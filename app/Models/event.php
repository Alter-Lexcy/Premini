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
        'venue_id',
        'categori_id',
        'stok',
    ];

    public function venue(){
        return $this->belongsTo(venue::class);
    }
    public function category(){
        return $this->belongsTo(Categori::class, 'categori_id');
    }
    public function artis(){
        return $this->belongsToMany(Artis::class, 'eventartist', 'event_id', 'artis_id');
    }
    public function sponsor(){
        return $this->belongsToMany(Sponsor::class, 'eventsponsors', 'event_id', 'sponsor_id');
    }
    
}
