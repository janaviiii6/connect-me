<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function showNotifications()
    {
        $notifications = auth()->user()->notifications;

        return view('notifications',compact('notifications'));
        // return view('view.', compact('notifications'));
    }
}
