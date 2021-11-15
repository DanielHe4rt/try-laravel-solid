<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {

    public function getLatestUsers() {
        return User::orderByDesc('created_at')->paginate(4);
    }

    public function getTotalRegisteredUsers(): int {
        return User::count();
    }

}