<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        User::create([
            'firstname' => 'Admin',
            'lastname' => '1',
            'email' => 'admin@upf.pf',
            'password' => Hash::make('azpoazpo'),
            'user_role_id' => 1,
            'api_token' => Str::random(60),
        ]);

        // Enseignant
        User::create([
            'firstname' => 'Enseignant',
            'lastname' => '1',
            'email' => 'enseignant@upf.pf',
            'password' => Hash::make('azpoazpo'),
            'user_job_id' => 1,
            'api_token' => Str::random(60),
        ]);

        // Etudiant
        User::create([
            'firstname' => 'Etudiant',
            'lastname' => '1',
            'email' => 'etudiant@upf.pf',
            'password' => Hash::make('azpoazpo'),
            'user_job_id' => 2,
            'api_token' => Str::random(60),
        ]);

        // Autres
        User::create([
            'firstname' => 'Autre',
            'lastname' => '1',
            'email' => 'autre@upf.pf',
            'password' => Hash::make('azpoazpo'),
            'user_job_id' => 3,
            'api_token' => Str::random(60),
        ]);
    }
}
