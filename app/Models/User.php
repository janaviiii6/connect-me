<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Musonza\Chat\Traits\Messagable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // use Messagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'location_id',
        'ride_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationships
    public function ride()
    {
        // dd('dfghj');
        return $this->belongsTo(Ride::class,'id','user_id');
    }
    public function userLocation()
    {
        return $this->hasOne(UserLocation::class);
    }
    public function location()
    {
        return $this->hasOneThrough(Location::class, UserLocation::class,'id','location_id','id','user_id');
    }

    public function hostPassengers()
    {
        return $this->hasMany(HostPassengers::class)
            ->where('role', 'host');
    }
    public function getHostForDestination($destination)
    {
        $ride = Ride::where('destination', $destination)->first();
        if ($ride) {
            $hostPassenger = $this->hostPassengerForRide($ride->id);
            if ($hostPassenger) {
                return $hostPassenger->user;
            }
        }
        return null;
    }
}
