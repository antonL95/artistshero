<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Images;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'title' => [app()->getLocale() => $this->faker->word()],
            'subtitle' => [app()->getLocale() => $this->faker->word()],
            'content' => [app()->getLocale() => $this->faker->word()],
            'published_at' => Carbon::now(),
            'created_by' => User::factory()->create()->id,
            'thumbnail_image_id' => Images::factory()->create()->id,
            'cover_image_id' => Images::factory()->create()->id,
        ];
    }
}
