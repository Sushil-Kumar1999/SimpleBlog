<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;
use App\Models\Profile;
use App\Models\Post;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create and save a new image for every profile in database
        Profile::all()->each(function($profile) {
            $image = new Image();
            $image->storage_path = "public/images/default_profile_image.png";
            $image->imageable_id = $profile->id;
            $image->imageable_type = "App\Models\Profile";
            $image->save();
        });

         // create and save a new image for every post in database
        Post::all()->each(function($post) {
            $image = new Image();
            $image->storage_path = "public/images/default_post_image.jpg";
            $image->imageable_id = $post->id;
            $image->imageable_type = "App\Models\Post";
            $image->save();
        });

    }
}
