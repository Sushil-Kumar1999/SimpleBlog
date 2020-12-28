<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $comment = new Comment();
        $comment->body = "This is a test comment";
        $comment->profile_id = 1;
        $comment->post_id = 1;
        $comment->save();

        Comment::factory()->count(100)->create();
    }
}
