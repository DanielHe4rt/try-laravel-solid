<?php

namespace App\Repositories;

use App\Models\User;
use App\Services\OAuth\DiscordService;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use App\Services\OAuth\GithubService;
use App\Services\OAuth\TwitchService;
use Illuminate\Support\Facades\Storage;


class AuthRepository {

    public function authenticate($provider, $code) {
        $service = $this->getProvider($provider);

        $response = $service->auth($code);
        $providerUser = $service->getAuthenticatedUser($response['access_token']);

        $user = $this->findOrCreate($provider, $providerUser);
        Auth::login($user);
    }

    public function logout() {
        Auth::logout();
    }

    private function getProvider($provider) {
        return match ($provider) {
            'twitch' => new TwitchService,
            'github' => new GithubService,
            'discord' => new DiscordService
        };
    }

    private function findOrCreate(string $provider, array $providerUser)
    {
        $payload = [
            $provider . '_username' => $providerUser['login'],
            "name" => $providerUser['name'],
            $provider . "_id" => $providerUser['id'],
            "email" => $providerUser['email'],
            'image' => $providerUser['avatar_url']
        ];

        if ($user = User::where($provider . "_id", $payload[$provider . '_id'])->first()) {
            return $user;
        }

        if ($user = User::where('email', $payload['email'])->first()) {
            $user->update([
                $provider . "_id" => $payload[$provider . '_id'],
                $provider . "_username" => $payload[$provider . '_username']
            ]);

            return $user;
        }
        $imagePath = 'avatars/' . Uuid::uuid4()->toString() . '.png';
        Storage::put('public/' . $imagePath, file_get_contents($payload['image']));
        $payload['image_path'] = $imagePath;

        return User::create($payload);
    }
}