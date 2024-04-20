<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Filter;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;
use Livewire\Component;

class Filters extends Component
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

    public function clearFilters(): void
    {
        $this->reset();

        $this->dispatch('clear-filter');
    }

    public function setFilter(string $type, int $id): void
    {
        $type = Str::ascii($type);

        if (isset($this->activeFilter[$type]) && (int) $this->activeFilter[$type] === $id) {
            unset($this->activeFilter[$type]);

            if ($this->activeFilter === []) {
                $this->activeFilter = null;
            }

            $this->dispatch('filter-changed', filterType: $type, filterId: $id);

            return;
        }

        if (\is_string($this->activeFilter)) {
            return;
        }

        $this->activeFilter[$type] = $id;
        $this->dispatch('filter-changed', filterType: $type, filterId: $id);
    }

    public function filterArtist(int $id): void
    {
        if ($this->artistId !== null && $id === (int) $this->artistId) {
            $this->artistId = null;

            $this->dispatch('artist-filter-changed', artistId: $id);

            return;
        }
        $this->artistId = $id;
        $this->dispatch('artist-filter-changed', artistId: $this->artistId);
    }

    /**
     * @return array<string, array<array<int|string, array|bool|int|string|null>>>
     */
    public function with(): array // @phpstan-ignore-line
    {
        $artists = Cache::remember('filter-artists', 60 * 60 * 24, static fn () => Artist::with('profileImage')->whereHas('products')->get());

        $artistsFilter = [];

        foreach ($artists as $artist) {
            $artistsFilter[] = [
                'id' => $artist->id,
                'name' => $artist->name,
                'url' => $artist->profileImage?->url,
                'active' => $artist->id === $this->artistId,
            ];
        }

        $filters = Filter::get();

        $parsedFilters = [];

        foreach ($filters as $filter) {
            $sanitizedType = Str::ascii($filter->type); // @phpstan-ignore-line
            $parsedFilters[$filter->type][] = [ // @phpstan-ignore-line
                'id' => $filter->id,
                'name' => $filter->name,
                'active' => isset($this->activeFilter[$sanitizedType]) && (int) $this->activeFilter[$sanitizedType] === $filter->id,
            ];
        }

        return ['filterArtists' => $artistsFilter, 'filters' => $parsedFilters];
    }

    public function render(): View
    {
        return view('livewire.filters', $this->with());
    }
}
