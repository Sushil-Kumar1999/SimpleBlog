<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Image;
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
            ->count(9)
            ->create();

        Profile::all()->each(function($profile) {
            $all_role_ids = Role::all()->pluck('id')->all();
            $role_ids_to_attach = array_slice($all_role_ids, 0, rand(1, count($all_role_ids)));
            $profile->roles()->syncWithoutDetaching($role_ids_to_attach);
        });
    }
}
