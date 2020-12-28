<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run()
    {
        $post = new Post();
        $post->title = "This is a test post";
        $post->content = Str::random(100);
        $post->profile_id = 1;
        $post->save();
    }
}
