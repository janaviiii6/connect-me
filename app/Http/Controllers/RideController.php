<?php

namespace App\Http\Controllers;

use App\Models\HostPassengers;
use App\Models\Location;
use App\Models\Passenger;
use App\Models\Ride;
use App\Models\User;
use App\Models\UserLocation;
use App\Notifications\PassengerAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;

class RideController extends Controller
{

    public function index(Request $request)
{
    // Get authenticated user
    $user = Auth::user();

    if ($request->has('destination')) {
        $destination = $request->input('destination');

        // Fetch rides with the same destination as the input
        $rides = Ride::where('destination', $destination)
            ->where('status', 'ACTIVE')
            ->latest()
            ->take(5)
            ->get();
    } else {
        // Fetch recently created rides that the authenticated user is hosting
        $rides = $user->ride()->where('status', 'ACTIVE')->latest()->take(5)->get();
    }

    if ($request->wantsJson()) {
        return response()->json($rides);
    }

    return view('rides.ride-details', compact('rides'));
}



    public function create()
    {
        $user = Auth::id();
        return view('rides.ride-details',compact('user'));
    }

    public function store(Request $request)
    {
        $currentDateTime = date('Y-m-d H:i:s');

        // Combine the current date with the wait_till_time input
        $waitTillDateTime = date('Y-m-d', strtotime($currentDateTime)) . ' ' . $request->wait_till_time;

        $validatedData = $request->validate([
            'destination' => 'required|string',
            'is_host' => 'boolean',
            'total_auto_fare' => 'nullable|integer',
            'wait_till_time' => 'nullable|date_format:H:i',
            'status' => 'nullable|string',
            'current_status' => 'nullable|string',
        ]);

        // dd($request->total_auto_fare);
        $ride = new Ride();
        $ride->destination = $validatedData['destination'];
        $ride->user_id = Auth::id();
        $ride->status = $validatedData['status'] ?? 'ACTIVE'; // default value is 'active'
        $ride->current_status = $validatedData['current_status'] ?? 'CONNECTING'; // default value is 'scheduled'

        // dd($request->has('host_id'));
        if ($request->has('is_host') && $request->is_host == true) {
            $ride->is_host = true;
            $ride->total_auto_fare = $validatedData['total_auto_fare'];
            $ride->wait_till_time = $waitTillDateTime;
        }

        // dd($request);
        $ride->save();
        if($ride->is_host == true)
        {
            $hostPassenger = new HostPassengers();
            $hostPassenger->user_id = auth()->user()->id;
            $hostPassenger->ride_id = $ride->id;
            $hostPassenger->role = 'host';
            $hostPassenger->destination = $ride->destination;
            $hostPassenger->save();
        }


        return redirect()->route('rides.show', [$ride->id]);

    }
    public function show(Ride $ride)
    {
        $hostUser = User::with('userLocation')->where('id', $ride->user_id)->first();
        // dd($hostUser->userLocation->location);
        $hostUserLocation = $hostUser->userLocation->location;

        // Get other users who have the same destination
        $otherUsers = User::join('rides', 'users.id', '=', 'rides.user_id')
        ->join('user_locations', 'users.id', '=', 'user_locations.user_id')
        // ->select('users.*', 'rides.destination', 'user_locations.location_id')
        ->where('rides.destination', $ride->destination)
        // ->where('users.id', '<>', $hostUser->id)
        // ->where('rides.id', '=', $ride->id)
        ->get();
        // dd($otherUsers);
        // Calculate the distance between the host user and other users
        // $maxDistance = 500; // Maximum distance in meters
        // $nearbyUsers = collect();
        // foreach ($otherUsers as $otherUser) {
        //     $otherUserLocation = $otherUser->userLocation;
        //     $userLatLng = $otherUserLocation->location;
        //     if (!is_null($userLatLng)) {
        //         $distance = Location::distance_between_locations(
        //             $hostUserLocation->latitude,
        //             $hostUserLocation->longitude,
        //             $userLatLng->latitude,
        //             $userLatLng->longitude
        //         );
        //         if ($distance <= $maxDistance) {
        //             $otherUser->distance = $distance;
        //             $otherUser->destination = $ride->destination;
        //             $nearbyUsers->push($otherUser);
        //         }
        //     }
        // }
        // dd($nearbyUsers);

        return view('rides.connect-users', compact('ride','hostUser', 'otherUsers'));


        }


        public function addPassenger(Request $request, $ride,User $user)
        {
            $ride = Ride::findOrFail($request->input('ride_id'));
            $user = Auth()->user();
            // dd($user);

            // Check if user has already joined the ride as a passenger
            $hasJoined = HostPassengers::where('user_id', $user->id)
            ->where('ride_id', $ride->id)
            ->where('role', 'passenger')
            ->exists();

            if ($hasJoined) {
                return redirect()->back()->withErrors(['msg', 'You have already joined this ride.']);
            }

            if ($ride->is_host) {
                // Check if there are less than two passengers with the same destination
                $passengerCount = HostPassengers::where('ride_id', $ride->id)
                    ->where('role', 'passenger')
                    ->join('rides', 'rides.id', '=', 'host_passengers.ride_id')
                    ->where('rides.destination', $ride->destination)
                    ->count();
                if ($passengerCount <= 2) {
                    // Create new HostPassenger record for the passenger
                    $hostPassenger = new HostPassengers();
                    $hostPassenger->user_id = $user->id;
                    $hostPassenger->ride_id = $ride->id;
                    $hostPassenger->role = 'passenger';
                    $hostPassenger->destination = $ride->destination;
                    $hostPassenger->save();

                    // Send notification to the host user
                    if (dd($user->id !== $ride->host->id)) {
                        $ride->host->notify(new PassengerAdded($ride, $user));
                    }


                    return redirect()->back()->with('msg', 'Passenger added successfully.');
                } else {
                    return redirect()->back()->withErrors(['This ride already has two passengers with the same destination.']);
                }
            } else {
                // If the ride is not hosted, create new HostPassenger record for the passenger
                $hostPassenger = new HostPassengers();
                $hostPassenger->user_id = $user->id;
                $hostPassenger->ride_id = $ride->id;
                $hostPassenger->role = 'passenger';
                $hostPassenger->destination = $ride->destination;
                $hostPassenger->save();

                return redirect()->back()->with('msg', 'Passenger added successfully.');
            }



            return redirect()->back()->with('msg', 'Passenger added successfully.');

        }

}
