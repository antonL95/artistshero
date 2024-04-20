<?php

declare(strict_types=1);

use App\Livewire\ProductDetail;
use App\Models\Product;
use Livewire\Livewire;

it('renders successfully', function () {
    Product::factory()->create(['id' => 1]);
    Livewire::test(ProductDetail::class, ['id' => 1])
        ->assertStatus(200);
});
