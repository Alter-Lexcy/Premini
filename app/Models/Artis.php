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
         // format untuk relasi many to many, yang mengirim data nya ke eventartist
        return $this->belongsToMany(event::class, 'eventartist', 'artis_id', 'event_id');
    }
}
