<?php

namespace App\Http\Requests\Guest\Auth;

use App\Repositories\UserRepository;
use Illuminate\Foundation\Http\FormRequest;

class LoginPostRequest extends FormRequest
{

    public function __construct(private UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authorize()
    {
        return !$this->userRepository->isLoggedIn();
    }

    public function rules()
    {
        return [
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required|max:255|min:8'
        ];
    }
}
