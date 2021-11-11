<?php

namespace App\Http\Controllers;

class ViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => 'viewLanding']);
    }

    public function viewLanding()
    {
        return view('welcome');
    }

    public function viewDashboard()
    {
        return view('dashboard');
    }
}
