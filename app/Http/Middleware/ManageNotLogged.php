<?php

namespace App\Http\Middleware;

use App\Repositories\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManageNotLogged
{
    public function __construct(private UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(Request $request, Closure $next): Response
    {
        if ($this->userRepository->isLoggedIn()) {
            return redirect()->route('index');
        }
        return $next($request);
    }
}
