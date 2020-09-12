<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This class define all user jobs suggested to a user when managing his account.
 * 
 */
class UserJob extends Model
{
    public const JOBS = [
        ['id' => 1, 'name' => 'Enseignant'],
        ['id' => 2, 'name' => 'Etudiant'],
        ['id' => 3, 'name' => 'Autre'],
    ];
}
