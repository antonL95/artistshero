<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;

    /**
     * @var array<mixed>|null
     */
    public ?array $otherProducts = null;

    public function mount(int $id): void
    {
        $this->product = Product::with(['images', 'filters'])->findOrFail($id);
        $this->otherProducts = Product::with('images')->where('id', '!=', $id)->where('artist_id', $this->product->artist_id)->get()->toArray();
    }

    public function render(): View
    {
        return view('livewire.product-detail');
    }
}
