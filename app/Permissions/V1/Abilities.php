<?php

namespace App\Permissions\V1;

use App\Models\User;

final class Abilities
{

    //global ticket
    public const CreateTicket = 'ticket:create';
    public const UpdateTicket = 'ticket:update';
    public const ReplaceTicket = 'ticket:replace';
    public const DeleteTicket = 'ticket:delete';

    //specific user can do 
    public const CreateOwnTicket = 'ticket:own:create';
    public const UpdateOwnTicket = 'ticket:own:update';
    public const DeleteOwnTicket = 'ticket:own:delete';

    //user action
    public const CreateUser = 'user:create';
    public const UpdateUser = 'user:update';
    public const ReplaceUser = 'user:replace';
    public const DeleteUser = 'user:delete';

    public static function getAbilites(User $user)
    {
        if ($user->is_manager) {
            return [
                self::CreateTicket,
                self::UpdateTicket,
                self::ReplaceTicket,
                self::DeleteTicket,
                
                self::CreateUser,
                self::UpdateUser,
                self::ReplaceUser,
                self::DeleteUser
            ];
        } else {
            return [
                self::CreateOwnTicket,
                self::UpdateOwnTicket,
                self::DeleteOwnTicket
            ];
        }
    }
}
