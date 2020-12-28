<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            "body" => $this->faker->paragraph,
            "profile_id" => Profile::inRandomOrder()->first()->id,
            "post_id" => Post::inRandomOrder()->first()->id
        ];
    }
}
