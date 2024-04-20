<?php

declare(strict_types=1);

use App\Livewire\BlogPost;
use App\Models\Post;
use Livewire\Livewire;

it('renders successfully', function () {
    Post::factory()->create(['id' => 1]);
    Livewire::test(BlogPost::class, ['id' => 1])
        ->assertStatus(200);
});
