<?php

namespace App\Services\OAuth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GithubService
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.github.com',
            'timeout' => 5.0
        ]);
    }

    public function githubAuth(string $code): array
    {
        $url = "https://github.com/login/oauth/access_token";
        try {
            $response = $this->client->request('POST', $url, [
                'form_params' => [
                    'client_id' => env('GITHUB_OAUTH_ID'),
                    'client_secret' => env('GITHUB_OAUTH_SECRET'),
                    'code' => $code,
                ],
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]);
            return json_decode($response->getBody(), true);
        } catch (GuzzleException $exception) {
            return ["deu merda: " . $exception->getMessage()];
        }
    }

    public function getGithubUser(string $token): array
    {
        $uri = "/user";
        $response = $this->client->request('GET', $uri, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}
