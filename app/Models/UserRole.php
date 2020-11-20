<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

    public const ADMIN = [
        'id' => 1, 'name' => 'admin'
    ];

    public const ROLES = [
        self::ADMIN,
        ['id' => 2, 'name' => 'user'],
    ];

}
