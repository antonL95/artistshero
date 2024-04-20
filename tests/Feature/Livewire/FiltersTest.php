<?php

declare(strict_types=1);

use App\Livewire\Filters;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Filters::class)
        ->assertStatus(200);
});
