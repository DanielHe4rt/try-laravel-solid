<?php

namespace App\Repositories;

use App\Repositories\UserRepository;
use App\Repositories\MessageRepository;

class ViewRepository {

    public function __construct(UserRepository $userRepository, MessageRepository $messageRepository)
    {
        $this->_userRepository = $userRepository;
        $this->_messageRepository = $messageRepository;
    }

    public function getLandingContent(): array {
        return [ 
            $this->_userRepository->getLatestUsers(), 
            $this->_userRepository->getTotalRegisteredUsers(), 
            $this->_messageRepository->getTotalMessagesSent() 
        ];
    }

    public function getDashboardContent(): array {
        return [ 
            $this->_messageRepository->getLatestMessages() 
        ];
    }

}