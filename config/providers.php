<?php

return [
    'twitch' => [
        'name' => 'Twitch',
        'enabled' => env('TWITCH_OAUTH_ENABLED', false),
        'base_uri' => env('TWITCH_OAUTH_BASE_URI'),
        'client_id' => env('TWITCH_OAUTH_ID'),
        'redirect_uri' => env('TWITCH_REDIRECT_URI'),
        'secret' => env('TWITCH_OAUTH_SECRET'),
        'scope' => env('TWITCH_OAUTH_SCOPES')
    ],

    'github' => [
        'name' => 'Github',
        'enabled' => env('GITHUB_OAUTH_ENABLED', false),
        'base_uri' => env('GITHUB_OAUTH_BASE_URI'),
        'client_id' => env('GITHUB_OAUTH_ID'),
        'redirect_uri' => env('GITHUB_REDIRECT_URI'),
        'secret' => env('GITHUB_OAUTH_SECRET'),
        'scope' => env('GITHUB_OAUTH_SCOPES')
    ],

    'discord' => [
        'name' => 'Discord',
        'enabled' => env('DISCORD_OAUTH_ENABLED', false),
        'base_uri' => env('DISCORD_OAUTH_BASE_URI'),
        'client_id' => env('DISCORD_OAUTH_ID'),
        'redirect_uri' => env('DISCORD_REDIRECT_URI'),
        'secret' => env('DISCORD_OAUTH_SECRET'),
        'scope' => env('DISCORD_OAUTH_SCOPES')
    ]
];