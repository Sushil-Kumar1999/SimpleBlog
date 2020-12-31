<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            "title" => $this->faker->sentence,
            "content" => $this->faker->paragraphs(3, true),
            "image_path" => "public/images/stock_image.jpg"
        ];
    }
}
