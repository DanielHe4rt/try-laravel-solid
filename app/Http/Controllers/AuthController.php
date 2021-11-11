<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\OAuth\GithubService;
use App\Services\OAuth\TwitchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller
{
    public function getTwitchProvider(Request $request)
    {
        if (!$code = $request->query('code')) {
            return redirect('/');
        }

        $service = new TwitchService();
        $response = $service->twitchAuth($code);
        $providerUser = $service->getTwitchUser($response['access_token']);

        $user = $this->findOrCreate('twitch', $providerUser);
        Auth::login($user);

        return redirect('/dashboard');
    }

    public function getGithubProvider(Request $request)
    {
        if (!$code = $request->query('code')) {
            return redirect('/');
        }

        $service = new GithubService();
        $response = $service->githubAuth($code);
        $providerUser = $service->getGithubUser($response['access_token']);

        $user = $this->findOrCreate('github', $providerUser);
        Auth::login($user);

        return redirect('/dashboard');
    }

    private function findOrCreate(string $provider, array $providerUser)
    {
        $payload = [
            $provider . '_username' => $providerUser['login'] ?? $providerUser['data'][0]['login'],
            "name" => $providerUser['name'] ?? $providerUser['data'][0]['display_name'],
            $provider . "_id" => $providerUser['id'] ?? $providerUser['data'][0]['id'],
            "email" => $providerUser['email'] ?? $providerUser['data'][0]['email'],
            'image' => $providerUser['avatar_url'] ?? $providerUser['data'][0]['profile_image_url']
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

    public function getLogout() {
        Auth::logout();

        return redirect('/');
    }
}
