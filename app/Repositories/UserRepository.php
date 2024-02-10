<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function logout(): void
    {
        session()->forget('user');
    }

    public function isLoggedIn(): bool
    {
        return session()->has('user');
    }

    public function getLoggedUser()
    {
        return session()->get('user');
    }

    public function login($user): void
    {
        session()->put('user', $user);
    }

    public function store($data = []): User
    {
        return User::create($data);
    }

    public function get($data = [], $paginate = false)
    {
        $query = User::query();

        if (isset($data['name'])) {
            $query->where('name', $data['name']);
        }

        if (isset($data['id'])) {
            $query->where('hashed_id', $data['id']);
        }

        if (isset($data['email'])) {
            $query->where('email', $data['email']);
        }

        return $paginate ? $query->paginate(10) : $query->get();
    }

    public function update($data, $id)
    {
        $user = User::findOrFail($id);
        return $user->update($data);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }
}
