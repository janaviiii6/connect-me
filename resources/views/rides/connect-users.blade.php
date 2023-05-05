@extends('layouts.app')

@section('user-dashboard')
<div class="col-md-12 mt-2">
    <div class="d-flex bd-highlight mt-2">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h1 style="font-size: 30px;margin-left: 80px;">User Ride Details</h1>
        </div>
    </div>
</div>



@foreach ($otherUsers as $user)
<div class="col-md-3 mt-3" style="margin-left: 80px;">
    <div class="card" style="width: 400px;">
        <div class="card-body">
            <div class="dropdown float-end">
                @if ($user->is_host)
                <div class="d-flex flex-column bd-highlight mb-3">

                        <form method="POST" action="{{ route('rides.addPassenger', ['ride_id' => $ride->id, 'user_id' => $user->id]) }}">
                            @csrf

                            <input type="hidden" name="ride_id" value="{{ $ride->id }}">
                            <input type="hidden" name="user_id" value="{{ $user->getKey()  }}">
                            <input type="hidden" name="role" value="passenger">
                            <button class="btn btn-circle btn-outline-primary ms-2 add-guest-btn" title="Add a guest"><i class="bx bx-plus"></i></button>
                        </form>
                        <span class="badge badge-soft-success mt-3">HOST</span>
                    </div>
                    {{-- @else
                    <button class="btn btn-circle btn-outline-primary ms-2 chat-btn" title="Chat with {{ $user->name }}" data-user-id="{{ $user->getKey() }}"><i class="bx bx-message-alt"></i></button> --}}
                @endif
                <span class="badge badge-soft-success mb-0">{{ $user->status }}</span>
            </div>
            <div class="d-flex align-items-center">
                <div><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="avatar-md rounded-circle img-thumbnail" /></div>
                <div class="flex-1 ms-3">
                    <h5 class="font-size-16 mb-1"><a href="#" class="text-dark user" >{{ $user->name }}</a></h5>
                    <span class="badge badge-soft-success mb-0">{{ $user->current_status }}</span>
                </div>
            </div>
            <div class="mt-3 pt-1 ps-2">
                <p class="text-muted mb-0">Destination: {{ $user->destination }}</p>
                @if ($user->is_host)
                    <p class="text-muted mb-0 mt-2">Total Auto Fare: {{ $user->total_auto_fare }}</p>
                    <p class="text-muted mb-0 mt-2">Waiting Time: {{ date('H:i', strtotime($user->wait_till_time)) }}</p>
                @endif
                </div>
            <div class="d-flex gap-2 pt-4">
                <button type="button" class="btn btn-soft-primary btn-sm w-50"><i class="bx bx-user me-1"></i> Profile</button>
                <button type="button" class="btn btn-outline-primary btn-sm w-50">View Location</button>
            </div>
        </div>
    </div>

</div>
@endforeach



@endsection

