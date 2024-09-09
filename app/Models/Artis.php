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
    public function events(){
        return $this->belongsToMany(event::class, 'eventartist', 'artis_id', 'event_id');
    }
}
