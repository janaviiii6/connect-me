<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use App\Models\UserLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{

    public function store(Request $request)
    {
        $userId = auth()->id();
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $location = Location::create([
            'latitude' => $latitude,
            'longitude' => $longitude
        ]);

        UserLocation::create([
            'user_id' => $userId,
            'location_id' => $location->id
        ]);

        return response()->json(['message' => 'Location stored successfully.']);
    }
    public function check()
    {
        $userId = auth()->id();
        $userLocation = UserLocation::where('user_id', $userId)->first();

        if ($userLocation) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false]);
        }
    }
}
