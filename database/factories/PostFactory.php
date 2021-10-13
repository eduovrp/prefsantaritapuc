<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\CategoryPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\Image;
use Faker\Provider\Lorem;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => Lorem::sentence(8, true),
            'text' => Lorem::text(2500),
            'src_img' => Image::imageUrl(1024, 400),
            'category_post_id' => CategoryPost::factory(),
            'date' => date('Y-m-d')
        ];
    }
}
