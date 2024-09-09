<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventsponsor extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'sponsor_id'
    ];

    public function event(){
        return $this->belongsTo(event::class,'event_id');
    }
    public function sponsor(){
        return $this->belongsTo(Sponsor::class,'sponsor_id');
    }
}
