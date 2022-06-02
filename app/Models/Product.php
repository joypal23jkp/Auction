<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;

    protected $fallible = [
        'product_title',
        'product_description',
        'product_base_price',
        'product_status',
        'product_sold_price',
        'product_author',
        'product_buyer',
        'product_category',
        'product_valid_till'
    ];

    /**
     * @return MorphMany
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get the comments for the blog post.
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'product_author');
    }

    /**
     * Get the comments for the blog post.
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'product_buyer');
    }

    public function bits(): HasMany
    {
        return $this->hasMany(BidProduct::class, 'bid_product_id');
    }

    /**
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}
