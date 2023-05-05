<?php

namespace App\Http\Controllers;

// use App\Models\Chat;

use App\Models\Chat as ModelsChat;
use Illuminate\Http\Request;
use Musonza\Chat\Facades\ChatFacade as Chat;

class ChatsController extends Controller
{
    public function index()
    {
        $users = ModelsChat::users();

        return view('messages', compact('users'));
    }

    public function show($id)
    {
        $messages = ModelsChat::messages($id);
        $user = ModelsChat::user($id);

        return view('chat', compact('messages', 'user'));
    }

    public function sendMessage($id)
    {
        $message = request()->get('message');
        ModelsChat::message($message)->from(auth()->user())->to($id)->send();

        return redirect()->back();
    }
}
