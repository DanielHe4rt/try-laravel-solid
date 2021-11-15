<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

/* aqui fiquei em duvida se um nome melhor seria algo como userrepository porem pensei q poderia ser bem confuso caso esse projeto fosse ter um crud proprio pra os usuarios se registrarem etc */
class MeRepository {

    function postAvatar($image): void {
        $imageName = Uuid::uuid4()->toString() . '.' . $image->getClientOriginalExtension();
        $image->storePubliclyAs('public/avatars', $imageName);

        Storage::delete('public/' . Auth::user()->image_path);

        $imagePath = 'avatars/' . $imageName;

        Auth::user()->update([
            'image_path' => $imagePath
        ]);
    }

    function delete(): void {
        Auth::user()->delete();
        Auth::logout();
    }

}