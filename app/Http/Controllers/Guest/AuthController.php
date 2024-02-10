<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\Auth\LoginPostRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function logout(){
        $userRepository = new UserRepository();
        $userRepository->logout();
        return redirect()->route('index');
    }

    public function loginPost(LoginPostRequest $request){
        $userRepository = new UserRepository();
        $checkUser = $userRepository->get([
            'email' => $request->email
        ])->first();
        if ($checkUser) {
            if (\Hash::check($request->password, $checkUser->password)) {
                $userRepository->login($checkUser);
                return redirect()->route('index');
            } else {
                return redirect()->back()->with($this->sendAlert('error', 'Hata!', 'Email veya şifre yanlış'));
            }
        } else {
            return redirect()->back()->with($this->sendAlert('error', 'Hata!', 'Email veya şifre yanlış'));
        }
    }
}
