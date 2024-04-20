<?php

declare(strict_types=1);

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Images extends Media
{
    use HasFactory;

    protected $table = 'media';

    public function getTable(): string
    {
        return 'media';
    }

    /**
     * @return Attribute<string, string>
     */
    #[\Override]
    protected function url(): Attribute
    {
        if ($this->disk === 'local') { // @phpstan-ignore-line
            return parent::url();
        }

        return Attribute::make(
            get: fn () => Storage::disk($this->disk)->url($this->path), // @phpstan-ignore-line
        );
    }
}
