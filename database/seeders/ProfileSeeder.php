<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Role;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        $profile = new Profile();
        $profile->about = "This is a test profile";
        $profile->last_active = now();
        $profile->user_id = 1;
        $profile->save();

        Profile::factory()->hasPosts(3)
            ->count(9)->create();

        Profile::all()->each(function($profile) {
            $roles = array(1, 2, 3);
            $roles_to_attach = array_slice($roles, 0, rand(1, 3));
            $profile->roles()->syncWithoutDetaching($roles_to_attach);
        });
    }
}
