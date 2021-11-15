<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostAvatarRequest;
use App\Repositories\MeRepository;

class MeController extends Controller
{
    public function __construct(MeRepository $repository)
    {
        $this->middleware('auth');
        $this->_repository = $repository;
    }

    public function postProfileAvatar(PostAvatarRequest $request)
    {
        $this->_repository->postAvatar($request->file('image'));

        return response()->json([], 200);
    }

    public function deleteMe()
    {
        $this->_repository->delete();     

        return redirect('/');
    }
}
