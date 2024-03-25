<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'locale',
        'published_at',
    ];


    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }


    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }


    public function filters(): BelongsToMany
    {
        return $this->belongsToMany(Filter::class, ProductFilter::class, 'product_id', 'filter_id');
    }


    public function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }
}
