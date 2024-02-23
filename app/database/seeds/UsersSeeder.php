<?php

namespace App\Database\Seeds;

use App\Models\User;
use App\Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Leaf\Helpers\Password;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $user = new User();
        $user->email = 'sefa@sefa.com';
        $user->password = Password::hash('sefa');
        $user->save();
    }
}
