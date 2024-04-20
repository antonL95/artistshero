<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Images;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImagesFactory extends Factory
{
    protected $model = Images::class;

    /**
     * {@inheritDoc}
     */
    public function definition(): array
    {
        return [
            'disk' => 'r2',
            'directory' => 'media',
            'visibility' => 'public',
            'name' => $this->faker->name,
            'path' => 'media/'.$this->faker->name,
            'width' => random_int(1, 1000),
            'height' => random_int(1, 1000),
            'size' => random_int(1, 1000),
            'type' => 'image/jpeg',
            'ext' => '.jpg',
            'title' => $this->faker->name,
        ];
    }
}
