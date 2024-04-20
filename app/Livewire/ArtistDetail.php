<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Artist;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ArtistDetail extends Component
{
    public Artist $artist;

    public function mount(int $id): void
    {
        $this->artist = Artist::with(['products', 'profileImage', 'coverImage', 'otherImages'])->findOrFail($id);
    }

    public function render(): View
    {
        return view('livewire.artist-detail');
    }
}
