<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\User;

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
    }
}
