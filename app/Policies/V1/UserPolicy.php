<?php

namespace App\Policies\V1;

use App\Models\Ticket;
use App\Models\User;
use App\Permissions\V1\Abilites;
use App\Permissions\V1\Abilities;

class UserPolicy
{

    public function store(User $user, User $model): bool
    {
        return $user->tokenCan(Abilities::CreateUser);
    }


    public function update(User $user): bool
    {
        return $user->tokenCan(Abilities::UpdateUser);
    }


    //foreign key constraints failed
    public function delete(User $user, User $model): bool
    {
        return $user->tokenCan(Abilities::DeleteUser);
    }


    //replace policy
    public function replace(User $user): bool
    {
        return $user->tokenCan(Abilities::ReplaceUser);
    }
}
