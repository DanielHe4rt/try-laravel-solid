<?php

namespace App\Services\OAuth;

use App\Contracts\OAuthContract;
use GuzzleHttp\Client;

class TwitchService implements OAuthContract
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.twitch.tv/helix/',
            'timeout' => 5.0
        ]);
    }

    public function auth(string $code): array 
    {
        $uri = "https://id.twitch.tv/oauth2/token";
        $response = $this->client->request('POST', $uri, [
            'form_params' => [
                'client_id' => config('providers.twitch.client_id'),
                'client_secret' => config('providers.twitch.secret'),
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => config('providers.twitch.redirect_uri')
            ]
        ]);

        $payload = json_decode($response->getBody(), true);

        return [
            'access_token' => $payload['access_token']
        ];
    }

    public function getAuthenticatedUser(string $token): array
    {
        $uri = "users";
        $response = $this->client->request('GET', $uri, [
            'headers' => [
                'Client-ID' => config('providers.twitch.client_id'),
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/vnd.twitchtv.v5+json'
            ]
        ]);

        $payload = json_decode($response->getBody(), true);

        return [
            'login' => $payload['data'][0]['login'],
            'name' => $payload['data'][0]['display_name'],
            'id' => $payload['data'][0]['id'],
            'email' => $payload['data'][0]['email'],
            'avatar_url' => $payload['data'][0]['profile_image_url']
        ];
    }
}
