<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HostPassengers extends Model
{
    use HasFactory;
    use Notifiable;
    protected $guarded = ['id'];
    public function ride()
    {
        return $this->belongsTo(Ride::class);
    }

}
