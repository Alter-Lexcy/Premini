<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_sponsor',
        'kontribusi'
    ];
    public function events(){
        return $this->belongsToMany(event::class, 'eventsponsors', 'sponsor_id', 'event_id');
    }
}
