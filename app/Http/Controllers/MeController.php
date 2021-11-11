<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class MeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function postProfileAvatar(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image'
        ]);

        $file = $request->file('image');

        $imageName = Uuid::uuid4()->toString() . '.' . $file->getClientOriginalExtension();
        $file->storePubliclyAs('public/avatars', $imageName);

        Storage::delete('public/' . Auth::user()->image_path);

        $imagePath = 'avatars/' . $imageName;

        Auth::user()->update([
            'image_path' => $imagePath
        ]);

        return response()->json([], 200);
    }

    public function deleteMe()
    {
        Auth::user()->delete();
        Auth::logout();

        return redirect('/');
    }
}
