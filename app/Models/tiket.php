<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tiket extends Model
{
    use HasFactory;
    protected $fillable = [
        'Nama_id',
        'event_id',
        'jumlah_tiket'
    ];

    public function peserta()
    {
        // format untuk relasi one to many
        return $this->belongsTo(Attende::class,'Nama_id');
    }
    public function event()
    {
        // format untuk relasi one to many
        return $this->belongsTo(event::class);
    }
}
