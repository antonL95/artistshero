<?php

declare(strict_types=1);

use App\Livewire\Carousel;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Carousel::class)
        ->assertStatus(200);
});
