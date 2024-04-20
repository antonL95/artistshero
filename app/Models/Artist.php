<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Artist extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'profile_image_id',
        'cover_image_id',
        'other_image_ids',
        'published_at',
        'created_by',
        'updated_by',
    ];

    /** @var array|string[] */
    public array $translatable = [
        'name',
        'bio',
    ];

    /**
     * @return BelongsTo<User, self>
     */
    protected function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo<User, self>
     */
    protected function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * @return HasMany<Product>
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'artist_id', 'id');
    }

    /**
     * @return BelongsTo<Images, self>
     */
    public function profileImage(): BelongsTo
    {
        return $this->belongsTo(Images::class, 'profile_image_id', 'id');
    }

    /**
     * @return BelongsTo<Images, self>
     */
    public function coverImage(): BelongsTo
    {
        return $this->belongsTo(Images::class, 'cover_image_id', 'id');
    }

    /**
     * @return BelongsToMany<Images>
     */
    public function otherImages(): BelongsToMany
    {
        return $this
            ->belongsToMany(Images::class, 'artist_images', 'artist_id', 'media_id');
    }

    /**
     * @return string[]
     */
    public function casts(): array
    {
        return [
            'name' => 'json',
            'bio' => 'json',
            'published_at' => 'datetime',
        ];
    }
}
