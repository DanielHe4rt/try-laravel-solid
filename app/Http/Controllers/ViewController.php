<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;

class ViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => 'viewLanding']);
    }

    public function viewLanding()
    {
        $users = User::orderByDesc('created_at')->paginate(4);
        $registeredUsers = User::count();
        $messagesSent = Message::count();

        return view('welcome', compact(['users', 'registeredUsers', 'messagesSent']));
    }

    public function viewDashboard()
    {
        $messages = Message::orderByDesc('created_at')
            ->where('is_private', false)
            ->orWhere('receiver_username', '=', auth()->user()->github_username)
            ->orWhere('user_id', auth()->user()->id)
            ->paginate(15);
        return view('dashboard', compact('messages'));
    }

    public function viewProfile()
    {
        return view('profile');
    }
}
