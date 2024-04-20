<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class BlogPost extends Component
{
    public Post $post;

    public function mount(int $id): void
    {
        $this->post = Post::with('images')->findOrFail($id);
    }

    public function render(): View
    {
        return view('livewire.blog-post');
    }
}
