<?php

namespace App\Contracts;

interface OAuthContract {
    public function auth(string $code): array;
    public function getAuthenticatedUser(string $token): array;
}