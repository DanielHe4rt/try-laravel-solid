<?php

namespace App\Repositories;

use App\Models\Message;
use App\Services\OAuth\GithubService;
use Exception;
use Illuminate\Support\Facades\Auth;

class MessageRepository {

    public function __construct(GithubService $service)
    {
        $this->_service = $service;
    }

    public function createMessage($fields): Message {
        $fields['is_private'] = isset($fields['receiver_username']);
        $fields['receiver_username'] = strtolower($fields['receiver_username']);

        if (!$fields['is_private'])
            return Auth::user()->messages()->create($fields);
    
        $user = $this->_service->findUser($fields['receiver_username']);

        if (empty($user))
            throw new Exception('Github user does not exist.');

        return Auth::user()->messages()->create($fields);
    }

    public function getLatestMessages() {
        $messages = Message::orderByDesc('created_at')
            ->where('is_private', false)
            ->orWhere('receiver_username', '=', auth()->user()->github_username)
            ->orWhere('user_id', auth()->user()->id)
            ->paginate(15);

        return $messages;
    }

    public function getTotalMessagesSent(): int {
        return Message::count();
    }

}