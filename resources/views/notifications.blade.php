@extends('layouts.app')
@section('user-dashboard')
{{ dd($notifications); }}
@if(count($notifications) > 0)
    @foreach($notifications as $notification)
        @if($notification->type == 'App\Notifications\PassengerAdded')
            <div class="alert alert-info">
                <strong>New Passenger Added!</strong> {{ $notification->data['passenger_name'] }} has joined your ride.
            </div>
        @endif
    @endforeach
@else
    <p>You have no notifications at the moment.</p>
@endif
@endsection
