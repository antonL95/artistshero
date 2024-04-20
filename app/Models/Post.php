<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'title',
        'subtitle',
        'content',
        'published_at',
    ];

    /** @var array|string[] */
    protected array $translatable = [
        'title',
        'subtitle',
        'content',
    ];

    /**
     * @return BelongsTo<User, self>
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo<User, self>
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * @return BelongsTo<Images, self>
     */
    public function coverImage(): BelongsTo
    {
        return $this->belongsTo(Images::class, 'cover_image_id');
    }

    /**
     * @return BelongsTo<Images, self>
     */
    public function thumbnail(): BelongsTo
    {
        return $this->belongsTo(Images::class, 'thumbnail_image_id');
    }

    /**
     * @return BelongsToMany<Images>
     */
    public function images(): BelongsToMany
    {
        return $this
            ->belongsToMany(Images::class, 'post_images', 'post_id', 'media_id');
    }

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'title' => 'array',
            'subtitle' => 'array',
            'content' => 'array',
            'published_at' => 'datetime',
        ];
    }
}
