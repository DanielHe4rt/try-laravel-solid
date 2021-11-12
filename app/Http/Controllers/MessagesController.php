<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function postMessage(Request $request)
    {
        $fields = $this->validate($request, [
            'content' => 'required',
            'receiver_username' => 'string|nullable'
        ]);

        $fields['is_private'] = (bool) $request->input('is_private');
        $fields['receiver_username'] = strtolower($fields['receiver_username']);

        Auth::user()->messages()->create($fields);

        return back();
    }
}
