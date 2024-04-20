<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Images;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistFactory extends Factory
{
    protected $model = Artist::class;

    public function definition(): array
    {
        return [
            'name' => [app()->getLocale() => $this->faker->name()],
            'bio' => [app()->getLocale() => $this->faker->word()],
            'created_by' => User::factory()->create()->id,
            'profile_image_id' => Images::factory()->create()->id,
            'cover_image_id' => Images::factory()->create()->id,
        ];
    }
}
