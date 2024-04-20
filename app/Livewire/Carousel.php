<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Carousel extends Component
{
    /**
     * @var Product[]
     */
    public array $items;

    public function render(): View
    {
        return view('livewire.carousel');
    }
}
