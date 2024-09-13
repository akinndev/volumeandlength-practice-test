<?php

namespace App\Repositories\Implements;

use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function oauth(string $provider, string $oauthId, array $params): User
    {
        $user = User::where($provider, $oauthId)
            ->orWhere('email', $params['email'])->first();

        if (!$user) {
            $user = User::create([
                'name' => $params['name'],
                'email' => $params['email'],
                'google_id' => $params['google_id'],
                'avatar' => $params['avatar'],
            ]);
        }

        return $user;
    }

    public function store(array $params): User
    {
        return User::create([
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => Hash::make($params['password']),
        ]);
    }

    public function update(User $user, array $params): bool
    {
        $user->fill($params);
        return $user->save();
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
