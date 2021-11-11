<?php

namespace App\Services\OAuth;

use GuzzleHttp\Client;

class TwitchService
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.twitch.tv/helix/',
            'timeout' => 5.0
        ]);
    }

    public function twitchAuth(string $code): array
    {
        $uri = "https://id.twitch.tv/oauth2/token";
        $response = $this->client->request('POST', $uri, [
            'form_params' => [
                'client_id' => env('TWITCH_OAUTH_ID'),
                'client_secret' => env('TWITCH_OAUTH_SECRET'),
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => env('TWITCH_REDIRECT_URI')
            ]
        ]);
        return json_decode($response->getBody(), true);
    }

    public function getTwitchUser(string $token): array
    {
        $uri = "users";
        $response = $this->client->request('GET', $uri, [
            'headers' => [
                'Client-ID' => env('TWITCH_OAUTH_ID'),
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/vnd.twitchtv.v5+json'
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}
