@extends('layouts.app')
@section('user-dashboard')

<div class="col-md-4 ride-bg-color" id="user-details-column">
    <div class="user-ride-form-details pt-4">
        <form action="{{ route('rides.store') }}" id="ride-form" method="POST">
            @csrf
            <div class="user-destination">
                <input type="text" name="destination" id="destination" placeholder="Where to?">
            </div>


            <div class="host">
                <div class="form-group total_fare pt-6" id="total_fare_group" style="display: none;">
                    <input type="number" name="total_auto_fare" id="total_fare" value="{{ old('total_auto_fare') }}" min="0" placeholder="Total Fare">
                </div>

                <div class="form-group pt-2 wait-time" id="wait_till_time_group" style="display: none;">
                    <input type="time" name="wait_till_time" id="wait_till_time" value="{{ old('wait_till_time') }}" placeholder="Wait Time">
                </div>




                <div class="is_host ps-2 pt-3">
                    <input type="checkbox" id="is_host" name="is_host" value="1" {{ old('is_host') ? 'checked' : '' }}>
                    <label for="is_host">I want to host the ride</label>
                </div>
            </div>
            <div class="pt-4 user-ride-btn">
                <button type="submit" class="btn btn-submit">Submit</button>
            </div>
        </form>
    </div>
</div>

<div class="col-md-8" id="map">
    <!-- Create a div to hold the map -->
    <div id="mapid" style="height: 719px;width: 100%"></div>
</div>


@endsection
