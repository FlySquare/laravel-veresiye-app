<?php

namespace App\Http\Middleware;

use App\Repositories\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManageLogged
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function handle(Request $request, Closure $next): Response
    {
        if(session()->has('locale')){
            app()->setLocale(session('locale'));
        }else{
            app()->setLocale(config('app.locale'));
        }
        if ($this->userRepository->isLoggedIn() && !$request->routeIs('logout')) {
            $checkUser = $this->userRepository->get([
                'id' => $this->userRepository->getLoggedUser()->hashed_id
            ])->first();
            if ($checkUser) {
                $this->userRepository->login($checkUser);
                return $next($request);
            } else {
                $this->userRepository->logout();
                return redirect()->route('auth.login');
            }
        }
        if (!$this->userRepository->isLoggedIn() &&
            !$request->routeIs('auth.login') &&
            !$request->routeIs('auth.post-login')
        ) {
            return redirect()->route('auth.login');
        }
        return $next($request);
    }
}
