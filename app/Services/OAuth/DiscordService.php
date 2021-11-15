<?php

namespace App\Services\OAuth;

use App\Contracts\OAuthContract;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class DiscordService implements OAuthContract
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://discord.com/api/',
            'timeout' => 5.0
        ]);
    }

    public function auth(string $code): array
    {
        $url = "https://discord.com/api/oauth2/token";
        try {
            $response = $this->client->request('POST', $url, [
                'form_params' => [
                    'client_id' => config('providers.discord.client_id'),
                    'client_secret' => config('providers.discord.secret'),
                    'redirect_uri' => config('providers.discord.redirect_uri'),
                    'grant_type' => 'authorization_code',
                    'scope' => config('providers.discord.scope'),
                    'code' => $code,
                ],
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]);

            $payload = json_decode($response->getBody(), true);

            return [
                'access_token' => $payload['access_token']
            ];
        } catch (GuzzleException $exception) {
            return ["deu merda: " . $exception->getMessage()];
        }
    }

    public function getAuthenticatedUser(string $token): array
    {
        $uri = 'users/@me';
        $response = $this->client->request('GET', $uri, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token
            ]
        ]);

        $payload = json_decode($response->getBody(), true);

        return [
            'login' => $payload['username'],
            'name' => $payload['username'],
            'id' => $payload['id'],
            'email' => $payload['email'],
            'avatar_url' => 'https://cdn.discordapp.com/avatars/' . $payload['id'] . '/' . $payload['avatar']
        ];
    }
}
