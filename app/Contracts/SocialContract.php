<?php

namespace App\Contracts;

interface SocialContract {
    public function findUser(string $username): array;
}