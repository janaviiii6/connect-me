<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Location extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    // Relationship
    public function userLocation()
    {
        return $this->belongsTo(UserLocation::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }




    public static function distance_between_locations($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // meters
        $lat1 = deg2rad((float)$lat1);
        $lon1 = deg2rad((float)$lon1);
        $lat2 = deg2rad((float)$lat2);
        $lon2 = deg2rad((float)$lon2);

        $deltaLat = $lat2 - $lat1;
        $deltaLon = $lon2 - $lon1;

        $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
            cos($lat1) * cos($lat2) *
            sin($deltaLon / 2) * sin($deltaLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;
        return $distance;
    }

}
