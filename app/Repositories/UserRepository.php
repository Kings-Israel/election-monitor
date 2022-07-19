<?php

namespace App\Repositories;

use App\Models\User\User;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = User::class;

    /**
     * [__construct description].
     */
    public function __construct()
    {
    }

    public function getAllUsers($request)
    {
        $users = User::whereNotNull('id');

        return $users;
    }
}
