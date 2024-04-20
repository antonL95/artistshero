<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => [app()->getLocale() => $this->faker->word()],
            'description' => [app()->getLocale() => $this->faker->word()],
            'artist_id' => Artist::factory()->create()->id,
            'created_by' => User::factory()->create()->id,
        ];
    }
}
