<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ride extends Model
{
    use HasFactory;
    use Notifiable;
//    protected static function newFactory()
//    {
//        return \Database\Factories\RidesFactory::new();
//    }

    protected $fillable = [
        'user_id',
        'total_auto_fare',
        'wait_till_time',
        'is_host',
        'destination',
        'status',
        'current_status',
    ];

    public function users()
    {

        return $this->hasMany(User::class);
    }

    public function passengers()
    {
        return $this->hasMany(HostPassengers::class)
            ->where('role', 'passenger');
    }
}
