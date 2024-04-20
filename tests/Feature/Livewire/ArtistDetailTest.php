<?php

declare(strict_types=1);

use App\Livewire\ArtistDetail;
use App\Models\Artist;
use Livewire\Livewire;

it('renders successfully', function () {
    Artist::factory()->create(['id' => 1]);
    Livewire::test(ArtistDetail::class, ['id' => 1])
        ->assertStatus(200);
});
