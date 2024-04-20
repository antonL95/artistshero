<?php

declare(strict_types=1);

use App\Livewire\Gallery;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Gallery::class)
        ->assertStatus(200);
});
