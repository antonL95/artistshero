<?php

namespace Database\Factories;

use App\Models\Filter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FilterFactory extends Factory
{
    protected $model = Filter::class;


    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'type' => $this->faker->word(),
            'locale' => $this->faker->word(),
        ];
    }
}
