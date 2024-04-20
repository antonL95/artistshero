<?php

declare(strict_types=1);

use App\Livewire\ContactForm;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ContactForm::class)
        ->assertStatus(200);
});
