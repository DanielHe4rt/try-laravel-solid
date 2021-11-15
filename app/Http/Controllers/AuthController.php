<?php

namespace App\Http\Controllers;

use App\Repositories\AuthRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function __construct(AuthRepository $repository)
    {
        $this->_repository = $repository;
    }

    public function auth(Request $request, string $provider) {
        if (!$code = $request->query('code')) {
            return redirect('/');
        }

        $this->_repository->authenticate($provider, $code);

        return redirect('/dashboard');
    }

    public function getLogout() {
        $this->_repository->logout();

        return redirect('/');
    }
}
