<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new User();
        $user->name = "Test User";
        $user->email = "testuser@mail.com";
        $user->email_verified_at = now();
        $user->password = 'password';
        $user->remember_token = Str::random(10);
        $user->save();
    }
}
