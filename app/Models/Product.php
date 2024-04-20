<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'published_at',
    ];

    /** @var array|string[] */
    public array $translatable = [
        'name',
        'description',
    ];

    /**
     * @return BelongsTo<Artist, self>
     */
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

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
     * @return BelongsToMany<Filter>
     */
    public function filters(): BelongsToMany
    {
        return $this->belongsToMany(Filter::class, ProductFilter::class, 'product_id', 'filter_id');
    }

    /**
     * @return BelongsToMany<Images>
     */
    public function images(): BelongsToMany
    {
        return $this
            ->belongsToMany(Images::class, 'product_images', 'product_id', 'media_id');
    }

    /**
     * @return string[]
     */
    public function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }
}
