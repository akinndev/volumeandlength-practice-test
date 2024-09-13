<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface 
{
    public function oauth(string $provider, string $oauthId, array $params) : User;

    public function store(array $params) : User;

    public function update(User $user, array $params) : bool ;

    public function delete(User $user) : bool;
}