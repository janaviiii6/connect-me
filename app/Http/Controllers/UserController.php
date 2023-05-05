<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('user.show',compact('user'));
    }
    public function index()
    {
        $users = User::all();
        return view('user.dashboard',compact('users'));
    }
}
