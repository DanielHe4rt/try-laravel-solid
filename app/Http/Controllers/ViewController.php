<?php

namespace App\Http\Controllers;

use App\Repositories\ViewRepository;

class ViewController extends Controller
{
    public function __construct(ViewRepository $repository)
    {
        $this->middleware('auth:web', ['except' => 'viewLanding']);
        $this->_repository = $repository;
    }

    public function viewLanding()
    {
        [ $users, $registeredUsers, $messagesSent ] = $this->_repository->getLandingContent();

        return view('welcome', compact(['users', 'registeredUsers', 'messagesSent']));
    }

    public function viewDashboard()
    {
        [ $messages ] = $this->_repository->getDashboardContent();

        return view('dashboard', compact('messages'));
    }

    public function viewProfile()
    {
        return view('profile');
    }
}
