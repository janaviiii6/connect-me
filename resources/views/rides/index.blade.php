@extends('layouts.app')

@section('user-dashboard')
@foreach ($tripGroups as $group)
    {{ dd($tripGroups) }}
    <div class="trip-group">
        @if (isset($group['host']))
            <div class="trip-user">
                <span class="badge badge-primary">Host</span>
                {{ $group['host']['name'] }}
            </div>
        @endif
        @if (isset($group['guest1']))
            <div class="trip-user">
                {{ $group['guest1']['name'] }}
            </div>
        @endif
        @if (isset($group['guest2']))
            <div class="trip-user">
                {{ $group['guest2']['name'] }}
            </div>
        @endif
    </div>
@endforeach



@endsection
