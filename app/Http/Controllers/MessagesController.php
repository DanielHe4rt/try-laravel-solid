<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use App\Repositories\MessageRepository;
use Exception;

class MessagesController extends Controller
{
    public function __construct(MessageRepository $repository)
    {
        $this->middleware('auth');
        $this->_repository = $repository;
    }

    public function postMessage(CreateMessageRequest $request)
    {
        try {
            $this->_repository->createMessage($request->validated());
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        return back();
    }
}
