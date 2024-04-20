<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductFilter;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Gallery extends Component
{
    #[Url(history: true)]
    public null|int|string $artistId = null;

    /**
     * @var array<string, int>|string|null
     */
    #[Url(history: true)]
    public null|array|string $activeFilter = null;

    public function mount(): void
    {
        if ($this->activeFilter === '') {
            $this->activeFilter = null;
        }
        if ($this->artistId === '') {
            $this->artistId = null;
        }
    }

    #[On('artist-filter-changed')]
    public function artistFilter(int $artistId): void
    {
        if ($this->artistId !== null && $artistId === (int) $this->artistId) {
            $this->artistId = null;

            return;
        }

        $this->artistId = $artistId;
    }

    #[On('filter-changed')]
    public function filtersChanged(string $filterType, int $filterId): void
    {
        if (isset($this->activeFilter[$filterType]) && (int) $this->activeFilter[$filterType] === $filterId) {
            unset($this->activeFilter[$filterType]);

            if ($this->activeFilter === []) {
                $this->activeFilter = null;
            }

            return;
        }

        if (\is_string($this->activeFilter)) {
            return;
        }

        $this->activeFilter[$filterType] = $filterId;
    }

    #[On('clear-filter')]
    public function clearFilter(): void
    {
        $this->reset();
    }

    /**
     * @return array<string, array<int, array<int, array>>>
     */
    #[On('filter_changed')] // @phpstan-ignore-line
    public function with(): array
    {
        $products = Product::with(['images', 'filters', 'artist']);

        if ($this->artistId) {
            $products->where('artist_id', $this->artistId);
        }

        if ($this->activeFilter !== null) {
            $filters = ProductFilter::get();

            $productIdsWithFilters = [];
            foreach ($filters as $filter) {
                $productIdsWithFilters[$filter->product_id][] = $filter->filter_id;
            }

            $productIdsWithFilters = array_filter($productIdsWithFilters, function (array $filters) {

                if (\is_string($this->activeFilter) || $this->activeFilter === null) {
                    return true;
                }

                foreach ($this->activeFilter as $filter) {
                    if (!\in_array((int) $filter, $filters, true)) {
                        return false;
                    }
                }

                return true;
            });

            $products->whereIn('id', array_keys($productIdsWithFilters));
        }

        $finalProducts = [];

        foreach ($products->get() as $product) {
            $finalProducts[$product->artist_id][] = $product->toArray();
        }

        return ['products' => $finalProducts];
    }

    public function render(): View
    {
        return view('livewire.gallery', $this->with());
    }
}
